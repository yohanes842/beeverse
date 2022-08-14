<?php

namespace App\Http\Controllers;

use App\Models\User;

class TopupController extends Controller
{
    public function index(){
        return view('topup');
    }

    public function add_coin(User $user){
        if($user != auth()->user()){
            return redirect()->back()->with('message', __('message.problem'));
        } else{
            $user->balance = $user->balance + 100;
            $user->save();
    
            return redirect()->back()->with('message', __('message.add_coin')." ".number_format($user->balance)." ". __('general.coin'));
        }
       
    }
}
