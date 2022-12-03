<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::insert(
            [
                [
                    'name' => 'Order ',
                    'title' => 'Order ',
                    'logo_white' => '',
                    'logo_dark' => '',
                    'favicon' => '1660218636_favicon.png',
                    'phone1' => '',
                    'email1' => 'info@sitename.nl',
                    'email2' => 'info@sitename.nl',
                    'site_url' => 'www.sitename.nl',
                    'address1' => '',
                    'copy' => ' ',
                    'facebook' => '#',
                    'twitter' => '#',
                    'instagram' => '#',
                    'youtube' => '#',
                    'whatsapp' => '#',
                    'youtube' => '#',
                    'map_url' => '',
                    'map_address' => '',
                ]
            ],

        );
    }
}
