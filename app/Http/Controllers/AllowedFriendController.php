<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Friend;
use App\Models\AllowedFriend;

class AllowedFriendController extends Controller
{
    public function index()
    {
        $allowedfriends = AllowedFriend::all();
        $users = User::all();
        return view('users.allowedfriends.index', [
            'allowedfriends' => $allowedfriends,
            'users' => $users,
        ]);

        // $posts = Post::where('user_id', 1);
        // return view('users.friends.index', [
        //     'posts' => $posts
        // ]);
    }

    public function store(Request $request)
    {
        // dd(Input::get('reqs'));
        $allowedfriend = new AllowedFriend();
        $allowedfriend -> request_sender_id =  $request -> allow;
        $allowedfriend -> user_id = auth()->user() -> id;
        $allowedfriend -> save();

        Friend::where('request_sender_id', $request -> allow)->delete();
        return back();
        // dd($request->reqs);
    }

    public function delete(Request $request)
    {
        AllowedFriend::where('user_id', $request -> reqs)->delete();
        return back();
    }

}
