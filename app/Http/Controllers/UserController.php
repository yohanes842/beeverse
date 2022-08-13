<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function accountSetting(User $user){
        if($user != auth()->user()){
            return redirect()->back()->with('message', __('message.problem'));
        }elseif($user->visible_status_id == 1) {
            if($user->balance < 50) return redirect()->back()->with('message', __('message.insufficient'));
            $user->balance = $user->balance - 50;
            $user->visible_status_id = 2;
            $user->save();
            return redirect()->back()->with('message', __('message.success_private'));
        }
        elseif($user->visible_status_id == 2){
            if($user->balance < 5) return redirect()->back()->with('message', __('message.insufficient'));
            $user->balance = $user->balance - 5;
            $user->visible_status_id = 1;
            $user->save();
            return redirect()->back()->with('message', __('message.success_public'));
        }
        else{
            return redirect()->back()->with('message', __('message.problem'));
        }
    }

}
