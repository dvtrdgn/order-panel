<?php

namespace Database\Seeders;

use App\Models\Orderlist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Orderlist::insert(
            [
                [
                    'created_at' => now(),
                    'user_id' => 1,
                    'dealer_id' => 1,
                ],
                [
                    'created_at' => now(),
                    'user_id' => 2,
                    'dealer_id' => 2,
                ],
                [
                    'created_at' => now(),
                    'user_id' => 3,
                    'dealer_id' => 3,
                ],
            ],
        );
    }
}
