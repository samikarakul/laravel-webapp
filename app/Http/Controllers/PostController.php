<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Controllers;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->with(['user', 'likes'])->paginate(10);
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);



        if($request->hasFile('image')){
            // dd($request->image);

            $file = $request ->image;
            // $extension = $file -> getClientOriginalExtension();
            // dd($request -> image -> getClientOriginalName());
            // $filename = time() .'.' . $extension;
            $filename = $request -> image -> getClientOriginalName();
            $file -> move('images/yuklenen/', $filename);
            // $yuklenen -> $request -> image = $filename;
            $request->user()->posts()->create([
            'body' => $request->body,
            'image' => $filename
        ]);

        }



        // $yuklenen->save();

        return back();
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return back();
    }
}
