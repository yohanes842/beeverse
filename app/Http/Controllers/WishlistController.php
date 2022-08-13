<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function wishlist(User $user){
        $current = auth()->user();
        if($current == $user) return redirect()->back()->with('message', 'Sorry there is a problem. Please try again!');

        $wishlist = auth()->user()->wishlists()->where('wishlisted_user_id', $user->id)->first();

        if (!$wishlist) {
            $friend = Wishlist::where('id', $user->id)
                        ->where('wishlisted_user_id', $current->id)->first();
            if($friend){
                $friend->isFriend = true;
                $friend->save();

                Wishlist::create([
                    'user_id' => $current->id,
                    'wishlisted_user_id' => $user->id,
                    'isFriend' =>true,
                ]);
            }

            Wishlist::create([
                'user_id' => $current->id,
                'wishlisted_user_id' => $user->id,
                'isFriend' =>false,
            ]);
            
            return redirect()->back()->with('message', 'Added thumbs!');
        }

        $friend = Wishlist::where('id', $user->id)
                        ->where('wishlisted_user_id', $current->id)->first();
        if($friend){
            $friend->isFriend = false;
            $friend->save();
        }

        $wishlist->delete();

        return redirect()->back()->with('message', 'Removed thumbs!');
    }

    public function friends_index(){
        $friends = auth()->user()->wishlists()->with('user')->where('isFriend', true)->get();

        return view('friends')->with('friends', $friends);
    }
}
