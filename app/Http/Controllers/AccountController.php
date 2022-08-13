<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function login_index(){
        return view('login');
    }

    public function login_process(Request $request){
        $request->validate([
            'email' => ['required','email'],
            'password' => 'required',
        ]);

        if(Auth::attempt($request->only('email', 'password'))){
            $user = auth()->user();
            if($user->payment_status_id == 1){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('payment', $user);
            }
            $request->session()->regenerate();
            return redirect()->route('home')->with('message', __('message.login.success'));
        }
        return redirect()->back()->with('message', __('message.login.invalid'));
    }

    public function register_index(){
        $hobbies = Hobby::all();
        return view('register')->with('hobbies', $hobbies);
    }
    
    public function register_process(Request $request){
        $request->validate([
            'name' => ['required'],
            'nickname' => ['required', 'min:3', 'unique:users,nickname'],
            'age' => ['required', 'min:1'],
            'gender' => ['required', 'exists:genders,id'],
            'instagram_username'=> ['required', 'unique:users,instagram_username'],
            'mobile_number' => ['required', 'digits_between:11,13', 'regex:/^[0][0-9]{10,12}/'],
            'hobbies' => ['required', 'min:3'],
            'hobbies.*' => ['required'],
            'email' => ['required','email', 'unique:users,email'],
            'password' => ['required'],
            'confirm_password' => ['required', 'same:password']
        ],[
            'ig_username' => 'instagram username',
            'hobbies.min' => 'Select at least :min hobbies',
        ]);
        $hobbies = collect($request->hobbies)->implode('-');
        $newbie = User::create([
            'name' => $request->name,
            'nickname' => $request->nickname,
            'age' => $request->age,
            'hobby' => $hobbies,
            'gender_id' => $request->gender,
            'instagram_username' => 'http://www.instagram.com/'.$request->instagram_username,
            'mobile_number' => $request->mobile_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'balance' => 100,
            'visible_status_id' => 1,
            'payment_status_id' => 1,
            'payment_price' => random_int(100000, 125000),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('payment', $newbie);
    }

    public function payment_index(User $user){
        return view('registration-payment')->with('user', $user);
    }

    public function payment_process(Request $request, User $user){
        $request->validate([
            'amount' => 'required',
        ]);
        $sufficient = $user->payment_price - $request->amount;
        if($sufficient > 0){
            $sufficient = number_format($sufficient);
            return redirect()->route('payment', $user)->with('underpaid', __('message.payment.underpaid') .$sufficient. __('general.coin'));
        } else if($sufficient < 0){
            $overpaid = $sufficient*(-1);
            $user->payment_status_id = 2;
            $user->balance = $user->balance + $overpaid;
            $user->save();
            return redirect()->route('login')->with('message', __('message.payment.success')." ".number_format($user->balance)." ".__('general.coin'));
        } else{
            $user->payment_status_id = 2;
            $user->save();
            return redirect()->route('login')->with('message', __('message.payment.success') ." 0 ". __('general.coin'));
        }
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home')->with('message', __('message.logout.success'));
    }
}
