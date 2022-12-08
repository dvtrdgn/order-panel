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
                    'created_at' => now(),
                    'title' => 'PRODUCT 1',
                    'category_id' => 1,
                    'barcode' => 'borcode 1',
                    'size' => '125*125',
                    'quantity' => 100,
                    'alert_min_count' => 25,
                    'image' => '1670486806_product.jpg',                    
                ],
                [
                    'created_at' => now(),
                    'title' => 'PRODUCT 2',
                    'category_id' => 4,
                    'barcode' => 'borcode 2',
                    'size' => '125*125',
                    'quantity' => 100,
                    'alert_min_count' => 25,
                    'image' => '1670509499_product.jpg',                    
                ],
                [
                    'created_at' => now(),
                    'title' => 'PRODUCT 3',
                    'category_id' => 1,
                    'barcode' => 'borcode 1',
                    'size' => '125*125',
                    'quantity' => 100,
                    'alert_min_count' => 25,
                    'image' => '1670486806_product.jpg',                    
                ],
                [
                    'created_at' => now(),
                    'title' => 'PRODUCT 4',
                    'category_id' => 4,
                    'barcode' => 'borcode 2',
                    'size' => '125*125',
                    'quantity' => 100,
                    'alert_min_count' => 25,
                    'image' => '1670509499_product.jpg',                    
                ],
                [
                    'created_at' => now(),
                    'title' => 'PRODUCT 5',
                    'category_id' => 1,
                    'barcode' => 'borcode 5',
                    'size' => '125*125',
                    'quantity' => 100,
                    'alert_min_count' => 25,
                    'image' => '1670486806_product.jpg',                    
                ],
                [
                    'created_at' => now(),
                    'title' => 'PRODUCT 6',
                    'category_id' => 4,
                    'barcode' => 'borcode 6',
                    'size' => '125*125',
                    'quantity' => 100,
                    'alert_min_count' => 25,
                    'image' => '1670509499_product.jpg',                    
                ],
                
            ],
        );
    }
}
