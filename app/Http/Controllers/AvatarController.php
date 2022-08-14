<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\User;
use App\Models\UsersAvatar;
use App\Models\VisibleStatus;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    public function shop_index(){
        $avatars = Avatar::all();
        $avatars_had = UsersAvatar::with('avatar')->where('user_id', auth()->user()->id)->get();
        $friends = auth()->user()->wishlists()->with('user')->where('isFriend', true)->get();

        return view('avatar')->with([
            'avatars' => $avatars,
            'had' => $avatars_had,
            'friends' => $friends
        ]);
    }

    public function purchase(Avatar $avatar){
        $user = auth()->user();
        $isExists = $user->usersAvatars()->where('avatar_id', $avatar->id)->first();

        if($user->balance < $avatar->price){
            return redirect()->back()->with('warning', __('message.insufficient'));
        }elseif($isExists){
            return redirect()->back()->with('message', __('message.problem'));
        }

        $user->balance = $user->balance - $avatar->price;
        $user->save();

        UsersAvatar::create([
            'user_id' => $user->id,
            'avatar_id' => $avatar->id,
        ]);

        return redirect()->back()->with('message', __('message.avatar_success.purchase'));
    }

    public function collection_index(User $user){
        $collections = $user->usersAvatars()->get();

        return view('collection')->with([
            'collections' => $collections,
            'user' => $user,
        ]);
    }

    public function set_as_profile(Avatar $avatar){
        $user = auth()->user();
        $isExists = $user->usersAvatars()->where('avatar_id', $avatar->id)->first();

        if(!$isExists){
            return redirect()->back()->with('message', __('message.problem'));
        }
        
        $user->image_profile = $avatar->image_url;
        $user->save();

        return redirect()->back()->with('message', __('message.avatar_success.profile'));
    }

    public function send_avatar(Request $request, User $user){
        $avatar = json_decode($request->avatar);
        $current = auth()->user();

        $isExists = $user->usersAvatars()->where('avatar_id', $avatar->id)->first();

        if($current->balance < $avatar->price){
            return redirect()->back()->with('warning', __('message.insufficient'));
        }elseif($isExists){
            return redirect()->back()->with('message', 'Your friends already had this avatar! Send the other avatar from your list!');
        }

        $current->balance = $current->balance - $avatar->price;
        $current->save();

        UsersAvatar::create([
            'user_id' => $user->id,
            'avatar_id' => $avatar->id,
            'from_id' => $current->id
        ]);

        return redirect()->back()->with('message', __('message.avatar_success.send'));
    }
}
