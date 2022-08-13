<?php

namespace Database\Seeders;

use App\Models\Chat;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Chat::insert([
            [
                'chat_desc' => 'Hi, Andy',
                'user_id' => 7,
                'to_user_id' => 1,
            ],
            [
                'chat_desc' => 'Hi, Sasa',
                'user_id' => 1,
                'to_user_id' => 7,
            ],
            [
                'chat_desc' => 'Nice to meet you',
                'user_id' => 7,
                'to_user_id' => 1,
            ],
        ]);
    }
}
