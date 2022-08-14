<?php

namespace Database\Seeders;

use App\Models\Wishlist;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Wishlist::insert([
            [
                'user_id' => 1,
                'wishlisted_user_id' => 7,
                'isFriend' => false,
            ],
            [
                'user_id' => 7,
                'wishlisted_user_id' => 2,
                'isFriend' => true,
            ],
            [
                'user_id' => 2,
                'wishlisted_user_id' => 7,
                'isFriend' => true,
            ],
            [
                'user_id' => 3,
                'wishlisted_user_id' => 7,
                'isFriend' => true,
            ],
            [
                'user_id' => 7,
                'wishlisted_user_id' => 3,
                'isFriend' => true,
            ],
            [
                'user_id' => 7,
                'wishlisted_user_id' => 5,
                'isFriend' => true,
            ],
        ]);
    }
}
