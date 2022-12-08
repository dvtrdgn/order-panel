<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::insert(
            [
                [
                    'created_at' => now(),
                    'isCompleted' => 0,
                    'isDealerCompleteOrder' => 1,
                    'user_id' => 1,
                    'ordered_user_id' => 1,
                    'product_id' => 1,
                    'orderlist_id' => 1,
                    'quantity' => 20,
                    'category_id' => 1,
                    'dealer_id' => 1,
                ],
                [
                    'created_at' => now(),
                    'isCompleted' => 0,
                    'isDealerCompleteOrder' => 1,
                    'user_id' => 2,
                    'ordered_user_id' => 2,
                    'product_id' => 2,
                    'orderlist_id' => 1,
                    'quantity' => 29,
                    'category_id' => 2,
                    'dealer_id' => 1,
                ],
                [
                    'created_at' => now(),
                    'isCompleted' => 0,
                    'isDealerCompleteOrder' => 1,
                    'user_id' => 3,
                    'ordered_user_id' => 3,
                    'product_id' => 3,
                    'orderlist_id' => 1,
                    'quantity' => 55,
                    'category_id' => 3,
                    'dealer_id' => 1,
                ],
                [
                    'created_at' => now(),
                    'isCompleted' => 0,
                    'isDealerCompleteOrder' => 1,
                    'user_id' => 1,
                    'ordered_user_id' => 1,
                    'product_id' => 4,
                    'orderlist_id' => 1,
                    'quantity' => 10,
                    'category_id' => 1,
                    'dealer_id' => 1,
                ],
                [
                    'created_at' => now(),
                    'isCompleted' => 0,
                    'isDealerCompleteOrder' => 1,
                    'user_id' => 2,
                    'ordered_user_id' => 2,
                    'product_id' => 5,
                    'orderlist_id' => 1,
                    'quantity' => 7,
                    'category_id' => 2,
                    'dealer_id' => 1,
                ],
                [
                    'created_at' => now(),
                    'isCompleted' => 0,
                    'isDealerCompleteOrder' => 1,
                    'user_id' => 2,
                    'ordered_user_id' => 2,
                    'product_id' => 6,
                    'orderlist_id' => 1,
                    'quantity' => 6,
                    'category_id' => 3,
                    'dealer_id' => 1,
                ],

            ],
        );
    }
}
