@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            @auth
                <form action="{{ route('posts') }}" method="POST" class="mb-4" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="body" class="sr-only">Body</label>
                        <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100
                        border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror"
                        placeholder="Post Something!!"></textarea>
                        <input type="button" id="button" value="Open"
                        style="position: relative; left:-1px; background-color:#446655; width:20%;"/>
                        <input type="file" name="image" style="opacity:0; position:relative; left:-20%; width:20%;"
                         onChange="javascript: document.getElementById('fileName').value = 'Yükleme Başarılı!' "/>
                         <input type="text" id="fileName" readonly="readonly" style="color:deeppink;">

                        @error('body')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
                    </div>
                </form>
            @endauth
            @if($posts->count())
                @foreach ($posts as $post)
                <div class="mb-4 pb-4 bg-gray-200 ">
                    {{-- <div class="bg-yellow-600 mb-10" style="height:10px; width:100%;"></div> --}}

                    <a href="{{ route('users.posts', $post->user) }}" class="font-bold ">{{ $post->user->name }}</a>
                    <span class="text-gray-600 text-sm"> {{ $post->created_at->diffForHumans() }}</span>

                    <p class="mb-2" style="color: #fef5f4">{{ $post->body }}</p>
                    <img src="{{ URL::to('images/yuklenen/' . $post->image) }}" style="width:100%"/>
                    @can('delete', $post)
                        <a href="{{ URL::to('images/yuklenen/' . $post->image) }}" download="newname" target="_blank">
                            <button class="bg-yellow-500" style="width:100%;">Download Link</button></a>
                     @endcan


                    @can('delete', $post)
                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-blue-500">Delete</button>
                        </form>
                    @endcan


                    <div class="flex items-center">
                        @auth
                            @if(!$post->likedBy(auth()->user()))
                                <form action="{{ route('posts.likes', $post) }}" method="POST" class="mr-1">
                                    @csrf
                                    <button type="submit" class="text-blue-500 bg-gray-400"
                                    style="padding: 10px 20px; margin: 4px 2px; color:#fff;">like</button>
                                </form>
                            @else
                                <form action="{{ route('posts.likes', $post) }}" method="POST" class="mr-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-blue-500 bg-gray-400"
                                    style="padding: 10px 20px; margin: 4px 2px; color: #fff;">Unlike</button>
                                </form>
                            @endif


                        @endauth
                        <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count() ) }}</span>
                        <span>{{ $post->comments->count() }} {{ Str::plural('comment', $post->comments->count() ) }}</span>
                    </div>

                    <div class="flex flex-col mt-4">
                        @foreach ($post->comments as $comment)
                            <p class="mt-2 ml-5">{{ $comment->username }}</p>
                            <div class="bg-white mt-2 mb-4 mr-2 ml-2">

                                <p class="mt-2 ml-5">{{ $comment->content }}</p>
                            </div>
                        @endforeach
                    </div>
                    {{-- yorum yapma yeri burası --}}

                    <div>
                        <form action="{{ route('posts.comments', $post) }}" method="POST" class="mb-4" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="content" class="sr-only">Content</label>
                                <textarea name="content" id="content" cols="30" rows="4" class="bg-gray-100
                                border-2 w-full p-4 rounded-lg @error('content') border-red-500 @enderror"
                                placeholder="Post Something!!"></textarea>
                                @error('content')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Send</button>
                            </div>
                        </form>
                    </div>
                    {{-- yorum yapma yeri burası --}}

                </div>

                @endforeach

                {{ $posts->links() }}
            @else
                <p>There are no posts</p>
            @endif
        </div>
    </div>
@endsection
