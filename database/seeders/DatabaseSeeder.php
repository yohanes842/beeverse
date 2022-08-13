<?php

namespace Database\Seeders;

use App\Models\Avatar;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            VisibleStatusSeeder::class,
            PaymentStatusSeeder::class,
            HobbySeeder::class,
            GenderSeeder::class,
            UserSeeder::class,
            AvatarSeeder::class,
            WishlistSeeder::class,
            ChatSeeder::class,
        ]);
    }
}
