<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $user = auth()->user();
        if(isset($user)){
            $users = User::where('id', '!=', $user->id)->get();
        } else{
            $users = User::all();
        }


        return view('home')->with([
            'users' => $users,
            'hobbies' => Hobby::all(),
        ]);
    }

    public function search(Request $request){
        $keyword = $request->query('search-keyword');
        $gender_filter = $request->query('gender');
        $hobbies = $request->query('hobbies');

        $user = auth()->user();
        if(isset($user)){
            $users = User::where('id', '!=', $user->id);
        } else{
            $users = User::where('id', '!=', '');
        }

        if(isset($gender_filter)){
            $users = $users->where('gender_id', $gender_filter);
        }

        if(isset($keyword)){
            $users = $users->where(function ($whereQuery) use ($keyword) {
                $whereQuery = $whereQuery->orWhere('users.name', 'LIKE', "%$keyword%")
                    ->orWhere('users.nickname', 'LIKE', "%$keyword%")
                    ->orWhere('users.hobby', 'LIKE', "%$keyword%");
            });
        }

        if (!empty($hobbies)) {
            $users = $users->where(function ($whereQuery) use ($hobbies) {
                foreach ($hobbies as $hobby_name) {
                    $whereQuery = $whereQuery->orWhere('users.hobby', 'LIKE', "%$hobby_name%");
                }
            });
        }

        return view('home')->with([
            'keyword' => $keyword,
            'gender_filter' => $gender_filter,
            'users' => $users->get(),
            'hobbies_checked' => $hobbies, 
            'hobbies' => Hobby::all(),
        ]);
    }
}
