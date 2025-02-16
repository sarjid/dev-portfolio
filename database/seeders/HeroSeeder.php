<?php

namespace Database\Seeders;

use App\Models\Hero;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hero::create([
            'name' => "Habil",
            'title' => "Professional Software Developer.",
            'description' => "I transform complex challenges into seamless digital experiences,
                              crafting intuitive and scalable solutions that empower millions.",
            'cv_link' => "",
            'social_links' => [
                [
                    'platform' => 'Twitter',
                    'url' => 'https://x.com/sarjid',
                    'icon' => 'fa-brands fa-twitter'
                ],
                [
                    'platform' => 'LinkedIn',
                    'url' => 'https://www.linkedin.com/in/sarjid/',
                    'icon' => 'fa-brands fa-linkedin-in'
                ],
                [
                    'platform' => 'Github',
                    'url' => 'https://github.com/sarjid',
                    'icon' => 'fa-brands fa-github'
                ]
            ],
            'code_snippet' => "",
            'my_description' => "My name is Habil Mia. I am a professional and enthusiastic programmer in my daily life. I am a quick learner with a self-learning attitude. I love to learn and explore new technologies and am passionate about problem-solving. I love almost all the stacks of web application development and love to make the web more open to the world. My core skill is based on Php and I love to do most of the things using Php. I am available for any kind of job opportunity that suits my skills and interests.",
            'my_image' => "",
        ]);
    }
}
