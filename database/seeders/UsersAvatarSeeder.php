<?php

namespace Database\Seeders;

use App\Models\UsersAvatar;
use Illuminate\Database\Seeder;

class UsersAvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UsersAvatar::insert([
            [
                'user_id' => 1,
                'avatar_id' => 7,
                'from_id' => null
            ],
            [
                'user_id' => 2,
                'avatar_id' => 2,
                'from_id' => null
            ],
            [
                'user_id' => 3,
                'avatar_id' => 3,
                'from_id' => null
            ],
            [
                'user_id' => 4,
                'avatar_id' => 4,
                'from_id' => null
            ],
            [
                'user_id' => 4,
                'avatar_id' => 5,
                'from_id' => null
            ],
            [
                'user_id' => 5,
                'avatar_id' => 5, 
                'from_id' => null    
            ],
            [
                'user_id' => 6,
                'avatar_id' => 6,
                'from_id' => null
            ],
            [
                'user_id' => 7,
                'avatar_id' => 7,
                'from_id' => null                    
            ],
            [
                'user_id' => 7,
                'avatar_id' => 1,
                'from_id' => null
            ],
            [
                'user_id' => 7,
                'avatar_id' => 9,
                'from_id' => 1
            ],
        ]);
    }
}
