<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostCommentController extends Controller
{
    public function store(Post $post, Request $request)
    {
        if(!$post->commentedBy($request->user()))
        {
            $post->comments()->create([
                'user_id' => $request->user()->id,
                'post_id' => $post->id,
                'username' => auth() -> user()->name,
                'content' => $request -> content

            ]);
        }

        return back();
    }
}
