<?php

namespace Database\Seeders;

use App\Models\Dealer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DealerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dealer::insert(
            [
                [
                    'name' => 'dealer 1',
                    'phone' => '06876 01 791',

                ],
                [
                    'name' => 'dealer 2',
                    'phone' => '06876 01 791',

                ],
                [
                    'name' => 'dealer 3',
                    'phone' => '06876 01 791',

                ],
                [
                    'name' => 'dealer 4',
                    'phone' => '06876 01 791',

                ],
                [
                    'name' => 'dealer 5',
                    'phone' => '06876 01 791',

                ],

            ],
        );
    }
}
