<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use OpenApi\Attributes as OA;

class OrderController extends Controller
{
    #[OA\Get(
        path: '/api/v1/orders',
        summary: 'Get all orders',
        tags: ['Orders'],
        security: [['X-IAE-KEY' => []]]
    )]
    #[OA\Parameter(
        name: 'status',
        in: 'query',
        required: false,
        description: 'Filter by status (pending, processing, completed, cancelled)'
    )]
    #[OA\Response(
        response: 200,
        description: 'Success'
    )]
    #[OA\Response(
        response: 401,
        description: 'Unauthorized - Invalid or missing X-IAE-KEY'
    )]
    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->get();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data retrieved successfully',
            'data'    => $orders,
            'meta'    => [
                'service_name' => 'Order-Service',
                'api_version'  => 'v1',
                'total'        => $orders->count(),
            ],
        ], 200);
    }

    #[OA\Get(
        path: '/api/v1/orders/{id}',
        summary: 'Get order by ID',
        tags: ['Orders'],
        security: [['X-IAE-KEY' => []]]
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        required: true,
        description: 'Order ID'
    )]
    #[OA\Response(
        response: 200,
        description: 'Success'
    )]
    #[OA\Response(
        response: 404,
        description: 'Order not found'
    )]
    #[OA\Response(
        response: 401,
        description: 'Unauthorized'
    )]
    public function show($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Order not found',
                'errors'  => null,
            ], 404);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Data retrieved successfully',
            'data'    => $order,
            'meta'    => [
                'service_name' => 'Order-Service',
                'api_version'  => 'v1',
            ],
        ], 200);
    }

    #[OA\Post(
        path: '/api/v1/orders',
        summary: 'Create new order (Checkout)',
        tags: ['Orders'],
        security: [['X-IAE-KEY' => []]]
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ['customer_name', 'customer_email', 'items'],
            properties: [
                new OA\Property(property: 'customer_name', type: 'string', example: 'Budi Santoso'),
                new OA\Property(property: 'customer_email', type: 'string', example: 'budi@email.com'),
                new OA\Property(
                    property: 'items',
                    type: 'array',
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: 'product_id', type: 'integer', example: 1),
                            new OA\Property(property: 'name', type: 'string', example: 'Laptop Gaming'),
                            new OA\Property(property: 'price', type: 'number', example: 15000000),
                            new OA\Property(property: 'qty', type: 'integer', example: 1),
                        ]
                    )
                ),
                new OA\Property(property: 'discount', type: 'number', example: 500000),
                new OA\Property(property: 'notes', type: 'string', example: 'Tolong dibungkus rapi'),
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: 'Order created successfully'
    )]
    #[OA\Response(
        response: 422,
        description: 'Validation failed'
    )]
    #[OA\Response(
        response: 401,
        description: 'Unauthorized'
    )]
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name'      => 'required|string|max:255',
            'customer_email'     => 'required|email',
            'items'              => 'required|array|min:1',
            'items.*.product_id' => 'required|integer',
            'items.*.name'       => 'required|string',
            'items.*.price'      => 'required|numeric|min:0',
            'items.*.qty'        => 'required|integer|min:1',
            'discount'           => 'nullable|numeric|min:0',
            'notes'              => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $subtotal = collect($request->items)->sum(fn($item) => $item['price'] * $item['qty']);
        $discount = $request->discount ?? 0;
        $total    = $subtotal - $discount;

        $order = Order::create([
            'customer_name'  => $request->customer_name,
            'customer_email' => $request->customer_email,
            'items'          => $request->items,
            'subtotal'       => $subtotal,
            'discount'       => $discount,
            'total'          => $total,
            'status'         => 'pending',
            'notes'          => $request->notes,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Order created successfully',
            'data'    => $order,
            'meta'    => [
                'service_name' => 'Order-Service',
                'api_version'  => 'v1',
            ],
        ], 201);
    }

    #[OA\Patch(
        path: '/api/v1/orders/{id}/status',
        summary: 'Update order status',
        tags: ['Orders'],
        security: [['X-IAE-KEY' => []]]
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        required: true,
        description: 'Order ID'
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ['status'],
            properties: [
                new OA\Property(
                    property: 'status',
                    type: 'string',
                    enum: ['pending', 'processing', 'completed', 'cancelled'],
                    example: 'processing'
                ),
            ]
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'Status updated successfully'
    )]
    #[OA\Response(
        response: 404,
        description: 'Order not found'
    )]
    #[OA\Response(
        response: 401,
        description: 'Unauthorized'
    )]
    public function updateStatus(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Order not found',
                'errors'  => null,
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $order->update(['status' => $request->status]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Order status updated successfully',
            'data'    => $order->fresh(),
            'meta'    => [
                'service_name' => 'Order-Service',
                'api_version'  => 'v1',
            ],
        ], 200);
    }
}
