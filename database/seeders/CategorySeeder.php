<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert(
            [

                [
                    'id' => 1,
                    'parent_id' => 0,
                    'title' => 'BOOK MARKS',
                    'order' => 1
                ],
                [
                    'id' => 2,
                    'parent_id' => 0,
                    'title' => 'BOOKS',
                    'order' => 2
                ],
                [
                    'id' => 3,
                    'parent_id' => 0,
                    'title' => 'BOTTLE OPENERS',
                    'order' => 3
                ],
                [
                    'id' => 4,
                    'parent_id' => 0,
                    'title' => 'BAGS',
                    'order' => 4
                ],
                [
                    'id' => 5,
                    'parent_id' => 0,
                    'title' => 'COASTERS',
                    'order' => 5
                ],
                [
                    'id' => 6,
                    'parent_id' => 0,
                    'title' => 'FACE MASKS',
                    'order' => 6
                ],
                [
                    'id' => 7,
                    'parent_id' => 0,
                    'title' => 'MAGNETS',
                    'order' => 7
                ],
                [
                    'id' => 8,
                    'parent_id' => 0,
                    'title' => 'METAL PLATES',
                    'order' => 8
                ],
                [
                    'id' => 9,
                    'parent_id' => 0,
                    'title' => 'MOUSE PADS',
                    'order' => 9
                ],
                [
                    'id' => 10,
                    'parent_id' => 0,
                    'title' => 'MUGS',
                    'order' => 10
                ],
                [
                    'id' => 11,
                    'parent_id' => 0,
                    'title' => 'NOTEBOOKS',
                    'order' => 11
                ],
                [
                    'id' => 12,
                    'parent_id' => 0,
                    'title' => 'PHONE HOLDERS',
                    'order' => 12
                ],
                [
                    'id' => 13,
                    'parent_id' => 0,
                    'title' => 'POSTCARDS',
                    'order' => 13
                ],
                [
                    'id' => 14,
                    'parent_id' => 0,
                    'title' => 'POSTERS',
                    'order' => 14
                ],
                [
                    'id' => 15,
                    'parent_id' => 0,
                    'title' => 'TSHIRTS',
                    'order' => 15
                ],

            ],


        );
    }
}
