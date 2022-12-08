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
                    'name' => 'A dealer 1',
                    'phone' => '06876 01 791',

                ],
                [
                    'name' => 'B dealer 2',
                    'phone' => '06876 01 791',

                ],
                [
                    'name' => 'C dealer 3',
                    'phone' => '06876 01 791',

                ],
                [
                    'name' => 'D dealer 4',
                    'phone' => '06876 01 791',

                ],
                [
                    'name' => 'E dealer 5',
                    'phone' => '06876 01 791',

                ],

            ],
        );
    }
}
