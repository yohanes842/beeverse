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
                'chat_desc' => 'Hi, Sasa',
                'user_id' => 1,
                'to_user_id' => 7,
                'isRead' => true
            ],
            [
                'chat_desc' => 'Hi..',
                'user_id' => 7,
                'to_user_id' => 1,
                'isRead' => true
            ],
            [
                'chat_desc' => 'P',
                'user_id' => 1,
                'to_user_id' => 7,
                'isRead' => false
            ],
            [
                'chat_desc' => 'P',
                'user_id' => 1,
                'to_user_id' => 7,
                'isRead' => false
            ],
            [
                'chat_desc' => 'Let\'s meet together...',
                'user_id' => 1,
                'to_user_id' => 7,
                'isRead' => false
            ],
        ]);
    }
}
