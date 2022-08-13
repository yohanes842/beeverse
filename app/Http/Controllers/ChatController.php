<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(User $user){
        $current = auth()->user();
        $chats = Chat::where('user_id', $current->id)
                    ->where('to_user_id', $user->id)
                    ->orWhere(function ($whereQuery) use ($user, $current) {
                        $whereQuery = $whereQuery->where('chats.user_id', $user->id)
                                        ->where('chats.to_user_id', $current->id);
                    })->get();
        
        foreach($chats as $chat){
            $chat->isRead = true;
        }

        return view('chat')->with([
            'chats'=> $chats,
            'user'=> $user,
        ]);
    }

    public function add(Request $request, User $user){
        $current = auth()->user();
        
        Chat::create([
            'chat_desc' => $request->chat,
            'user_id' => $current->id,
            'to_user_id' => $user->id
        ]);
        
        return redirect()->route('chat', $user);
    }
}
