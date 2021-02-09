@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12">
            <div class="p-6">
                <h1 class="text-2xl font-medium mb-1">{{ $user->name }}</h1>
                <p>{{$user->name}} sayfasındayız</p>
                <p>{{auth()->user()->name}} giriş yapmış.</p>
                @if($user->name != auth()->user()->name)
                    @if($friends -> count() != 0)
                        @foreach($friends as $friend)
                                @if(($friend -> request_sender_id == auth()->user()->id) and ($user -> id == $friend -> user_id))
                                    <form action="{{ route('deleteFriend') }}" method="POST" class="mb-4" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                            <button value="{{ $user->id }}" type="submit" name="reqs" class="unfollowBtn bg-red-600 rounded-xl"><p class="p-3">Request Sended</p></button>
                                    </form>
                                    @break
                                @endif
                        @endforeach
                    @else
                        {{-- @if($allowedfriends -> count() != 0) --}}
                            <form action="{{ route('requser') }}" method="POST" class="mb-4" enctype="multipart/form-data">
                                @csrf
                                    <button value="{{ $user->id }}" type="submit" name="reqs"  class="followBtn bg-green-600 rounded-xl"><p class="p-3">Follow</p></button>
                            </form>
                        {{-- @endif --}}
                    @endif

                    @if($allowedfriends -> count() != 0)
                        @foreach($allowedfriends as $allowedfriend)
                            @if( ($allowedfriend -> request_sender_id == auth()->user()->id) and ($user -> id == $allowedfriend -> user_id) or ($allowedfriend -> request_sender_id == $user -> id) and ($user -> id == auth()->user()->id) )
                                <form action="{{ route('deleteFriendAllowed') }}" method="POST" class="mb-4" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                        <button value="{{ $user->id }}" type="submit" name="reqs" class="unfollowBtn bg-red-600 rounded-xl"><p class="p-3">Unfollow</p></button>
                                </form>
                                @break
                            @endif
                        @endforeach
                     @endif
                @endif

                <script>

                    showPanel();
                    function showPanel() {
                    var unfBtn = document.getElementsByClassName("unfollowBtn");
                    var fBtn = document.getElementsByClassName("followBtn");
                    console.log("fbtn length",fBtn.length)

                    // console.log(typeof(fBtn))
                    if(fBtn.length != 1)
                    {
                        for(var i=0; i<fBtn.length; i++)
                        {
                            var a = fBtn[i];
                            console.log(a);

                            a.remove();
                        }
                        // for(const child of fBtn)
                        // {
                        //     child.remove();
                        //     break;
                        // }
                    }

                    if(unfBtn.length != 0)
                    {

                        for(const child of fBtn)
                        {
                            child.remove();
                            console.log("unfbtn kontrol")
                        }
                    }
                    // while(fieldNameElement.childNodes.length >= 1) {
                    //     fieldNameElement.removeChild(fieldNameElement.firstChild);
                    // }
                    // fieldNameElement.appendChild(fieldNameElement.ownerDocument.createTextNode(fieldName));
                    }
                </script>


                <p> {{ $posts->count() }} {{ Str::plural('post', $posts->count())}} Posted </p>
                <p> Users like count: {{ $user->receivedLikes()->count() }}</p>
            </div>

            <div class="bg-white p-6 rounded-lg">
                @if($posts->count())
                    @foreach ($posts as $post)
                        <div class="mb-4">
                            <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a>
                            <span class="text-gray-600 text-sm"> {{ $post->created_at->diffForHumans() }}</span>

                            <p class="mb-2">{{ $post->body }}</p>

                            <img src="{{ URL::to('images/yuklenen/' . $post->image) }}" />

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
                                            <button type="submit" class="text-blue-500">like</button>
                                        </form>
                                    @else
                                        <form action="{{ route('posts.likes', $post) }}" method="POST" class="mr-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-blue-500">Unlike</button>
                                        </form>
                                    @endif


                                @endauth
                                <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count() ) }}</span>
                            </div>
                        </div>
                     @endforeach

                     {{ $posts->links() }}
                @else
                    <p>{{ $user->name }} does not have any posts.</p>
                @endif
            </div>

        </div>
    </div>
@endsection
