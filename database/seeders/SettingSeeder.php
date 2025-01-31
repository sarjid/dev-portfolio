<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'key' => 'name',
                'value' => 'Site Name'
            ],

            [
                'key' => 'email',
                'value' => 'site@gmail.com'
            ],

            [

                'key' => 'address',
                'value' => 'Dhaka,Bangladesh'
            ],
            [

                'key' => 'phone',
                'value' => '01722260010'
            ],

            [

                'key' => 'favicon',
                'value' => '/frontend/uploads/img/1773488092.jpg'
            ],

            [
                'key' => 'logo',
                'value' => '/frontend/uploads/img/1773488092.jpg'
            ],

            [
                'key' => 'whatsapp_link',
                'value' => '/frontend/uploads/img/1773488092.jpg'
            ],


        ];

        Setting::insert($data);
    }
}
