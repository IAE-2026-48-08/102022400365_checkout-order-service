<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $orders = [
            [
                'customer_name'  => 'Budi Santoso',
                'customer_email' => 'budi@email.com',
                'items'          => [
                    ['product_id' => 1, 'name' => 'Laptop Gaming ASUS', 'price' => 15000000, 'qty' => 1],
                    ['product_id' => 3, 'name' => 'Mouse Wireless', 'price' => 350000, 'qty' => 2],
                ],
                'subtotal' => 15700000,
                'discount' => 500000,
                'total'    => 15200000,
                'status'   => 'completed',
                'notes'    => 'Tolong dibungkus rapi',
            ],
            [
                'customer_name'  => 'Siti Rahayu',
                'customer_email' => 'siti@email.com',
                'items'          => [
                    ['product_id' => 5, 'name' => 'Headphone Sony', 'price' => 2500000, 'qty' => 1],
                ],
                'subtotal' => 2500000,
                'discount' => 0,
                'total'    => 2500000,
                'status'   => 'processing',
                'notes'    => null,
            ],
            [
                'customer_name'  => 'Ahmad Fauzi',
                'customer_email' => 'ahmad@email.com',
                'items'          => [
                    ['product_id' => 2, 'name' => 'Keyboard Mechanical', 'price' => 850000, 'qty' => 1],
                    ['product_id' => 4, 'name' => 'Monitor 24 inch', 'price' => 3200000, 'qty' => 1],
                ],
                'subtotal' => 4050000,
                'discount' => 200000,
                'total'    => 3850000,
                'status'   => 'pending',
                'notes'    => 'Kirim ke kantor',
            ],
        ];

        foreach ($orders as $data) {
            Order::create($data);
        }
    }
}
