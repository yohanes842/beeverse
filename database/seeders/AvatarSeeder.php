<?php

namespace Database\Seeders;

use App\Models\Avatar;
use Illuminate\Database\Seeder;

class AvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Avatar::insert([
            [
                'image_url' => 'avatar/avatar1.jpg',
                'name' => 'Sasa smiling',
                'price' => random_int(50, 100000),
            ],
            [
                'image_url' => 'avatar/avatar2.png',
                'name' => 'Tomm hello',
                'price' => random_int(50, 100000),
            ],
            [
                'image_url' => 'avatar/avatar3.jpg',
                'name' => 'Cindy hihi',
                'price' => random_int(50, 100000),
            ],
            [
                'image_url' => 'avatar/avatar4.png',
                'name' => 'Rony please...',
                'price' => random_int(50, 100000),
            ],
            [
                'image_url' => 'avatar/avatar5.png',
                'name' => 'Rony sorry',
                'price' => random_int(50, 100000),
            ],
            [
                'image_url' => 'avatar/avatar6.png',
                'name' => 'Steve cool!!',
                'price' => random_int(50, 100000),
            ],
            [
                'image_url' => 'avatar/avatar7.png',
                'name' => 'Steve Hii',
                'price' => random_int(50, 100000),
            ],
            [
                'image_url' => 'avatar/avatar8.png',
                'name' => 'Jhonny clap-clap',
                'price' => random_int(50, 100000),
            ],
            [
                'image_url' => 'avatar/avatar9.png',
                'name' => 'Sally happy',
                'price' => random_int(50, 100000),
            ],
            [
                'image_url' => 'avatar/avatar10.png',
                'name' => 'Jojo lowbat',
                'price' => random_int(50, 100000),
            ],
        ]);
    }
}
