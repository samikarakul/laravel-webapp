<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friend;

class UserPostController extends Controller
{
    public function index(User $user)
    {
        $posts = $user -> posts()->with(['user', 'likes'])->paginate(10);
        $friends = Friend::All();
        return view('users.posts.index', [
            'user' => $user,
            'posts' => $posts,
            'friends' => $friends
        ]);
    }
}
