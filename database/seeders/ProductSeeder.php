<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::insert(
            [
                [
                    'title' => 'PRODUCT 1',
                    'category_id' => 1
                ],
                [
                    'title' => 'PRODUCT 2',
                    'category_id' => 1
                ],
                [
                    'title' => 'PRODUCT 3',
                    'category_id' => 1
                ],
                [
                    'title' => 'PRODUCT 4',
                    'category_id' => 1
                ],
                [
                    'title' => 'PRODUCT 5',
                    'category_id' => 1
                ],
            ],
        );
    }
}
