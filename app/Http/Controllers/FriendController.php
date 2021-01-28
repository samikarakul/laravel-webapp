<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Friend;
use App\Http\Controllers;
// use Illuminate\Support\Facades\Input;

class FriendController extends Controller
{
    public function index()
    {
        $friends = Friend::all();
        $users = User::all();
        return view('users.friends.index', [
            'friends' => $friends,
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
        $friend = new Friend();
        $friend -> request_sender_id = auth()->user() -> id;
        $friend -> user_id = $request -> reqs;
        $friend -> save();

        return back();
        // dd($request->reqs);
    }

    public function delete(Request $request)
    {
        Friend::where('user_id', $request -> reqs)->delete();

        return back();


    }


}
