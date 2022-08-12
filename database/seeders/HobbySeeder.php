<?php

namespace Database\Seeders;

use App\Models\Hobby;
use Illuminate\Database\Seeder;

class HobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hobby::insert([
            [
                'hobby_name' => 'Swimming'
            ],
            [
                'hobby_name' => 'Reading'
            ],
            [
                'hobby_name' => 'Cooking'
            ],
            [
                'hobby_name' => 'Travelling'
            ],
            [
                'hobby_name' => 'Singing'
            ],
            [
                'hobby_name' => 'Watching'
            ],
            [
                'hobby_name' => 'Mountain climbing'
            ],
            [
                'hobby_name' => 'Painting'
            ],
            [
                'hobby_name' => 'Diving'
            ],
        ]);
    }
}
