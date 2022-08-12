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
            return redirect()->back()->with('message', "Sorry there is a problem. Please try again!");
        } else{
            $user->balance = $user->balance + 100;
            $user->save();
    
            return redirect()->back()->with('message', "+100 Your current balance : $user->balance coins");
        }
       
    }
}
