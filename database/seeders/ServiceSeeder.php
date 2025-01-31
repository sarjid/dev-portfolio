<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Logo Design',
                'slug' => 'logo-design',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo libero, nobis ut dicta fugiat optio iste deserunt. Explicabo deleniti assumenda labore fugit, hic unde aperiam!'
            ],

            [
                'name' => 'Complete Branding',
                'slug' => 'complete-branding',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo libero, nobis ut dicta fugiat optio iste deserunt. Explicabo deleniti assumenda labore fugit, hic unde aperiam!'
            ],

            [
                'name' => 'Social Media Design',
                'slug' => 'social-media-design',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo libero, nobis ut dicta fugiat optio iste deserunt. Explicabo deleniti assumenda labore fugit, hic unde aperiam!'
            ],
            [
                'name' => 'UI/UX Design',
                'slug' => 'ui-ux-design',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo libero, nobis ut dicta fugiat optio iste deserunt. Explicabo deleniti assumenda labore fugit, hic unde aperiam!'
            ],


        ];

        Service::insert($data);
    }
}