<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(User $user){
        $current = auth()->user();
        
        $read = Chat::where('user_id', $user->id)
            ->where('to_user_id', $current->id);
        
        foreach($read->get() as $chat){
            $chat->isRead = true;
            $chat->save();
        }

        $chats = $read->orWhere(function ($whereQuery) use ($user, $current) {
                        $whereQuery = $whereQuery->where('chats.user_id', $current->id)
                                        ->where('chats.to_user_id', $user->id);
                        })->get();

        return view('chat')->with([
            'chats'=> $chats,
            'user'=> $user,
        ]);
    }

    public function add(Request $request, User $user){
        if($request->chat){
            $current = auth()->user();
        
            Chat::create([
                'chat_desc' => $request->chat,
                'user_id' => $current->id,
                'to_user_id' => $user->id
            ]);
        }
        
        return redirect()->route('chat', $user);
    }
}
