<?php

namespace Database\Seeders;

use App\Models\VisibleStatus;
use Illuminate\Database\Seeder;

class VisibleStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VisibleStatus::insert([
            [
                'status_name' => 'public'
            ],
            [
                'status_name' => 'private'
            ],
        ]);
    }
}
