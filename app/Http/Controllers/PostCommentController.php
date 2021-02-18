<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class PostCommentController extends Controller
{
    public function store(Post $post, Request $request, Comment $comment)
    {
        // $post->comments()->create([
        //     'user_id' => $request->user()->id,
        //     'post_id' => $post->id,
        //     'username' => auth() -> user()->name,
        //     'content' => $request -> content

        // ]);



        // return back();

        $comment = new Comment();
        $comment -> user_id = $request -> user() -> id;
        $comment -> post_id = $post -> id;
        $comment -> username = auth() -> user() -> name;
        $comment -> content = $request -> content;
        $comment -> save();

        return back();
    }
}
