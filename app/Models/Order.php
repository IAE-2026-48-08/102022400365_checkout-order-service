<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_code',
        'customer_name',
        'customer_email',
        'items',
        'subtotal',
        'discount',
        'total',
        'status',
        'notes',
    ];

    protected $casts = [
        'items'    => 'array',
        'subtotal' => 'float',
        'discount' => 'float',
        'total'    => 'float',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($order) {
            $order->order_code = 'ORD-' . strtoupper(uniqid());
        });
    }
}
