@extends('layouts.app')

@section('content')
    @if ($allowedfriends->count() != 0)
        <div class="flex flex-row">
            @foreach($allowedfriends as $friend)
                {{-- @if($friend -> request_sender_id == auth()->user()->id) --}}
                    @foreach($users as $user)
                        @if( ( ($friend -> user_id == $user -> id) and ($friend -> request_sender_id == auth()->user()->id) ) or ( ($friend -> user_id == auth()->user()->id) and ($friend -> request_sender_id == $user -> id) ) )
                            <div class="max-w-xs rounded overflow-hidden shadow-lg my-2 ml-5 ">
                                <img class="w-full" src="https://vignette.wikia.nocookie.net/animepedia/images/c/ca/412-4.png/revision/latest/scale-to-width-down/340?cb=20180220090903&path-prefix=tr" alt="Sunset in the mountains">
                                <div class="px-6 py-4">
                                    <button class="font-bold text-xl mb-2"><a href="{{ route('users.posts', $user) }}">{{ $user -> name }}</a></button>
                                    <div class="font-bold text-xl mb-2">{{ $user -> id }}</div>
                                </div>
                                <div class="flex flex-row justify-between px-6 py-4">
                                    <button value="{{ $user->id }}" class="bg-green-600 rounded-xl" type="submit" name="allow" ><a href="{{ route('users.messages', $user->username) }}">Send Message</a></button>

                                    {{-- <form action="" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <button value="{{ $user->id }}" type="submit" name="reqs" class="bg-red-600 rounded-xl p-3">Delete Friend</button>
                                    </form> --}}

                                </div>
                            </div>
                        @endif
                    @endforeach
                {{-- @endif --}}
            @endforeach
        </div>

    @else
        <div class="max-w-xs rounded overflow-hidden shadow-lg my-2 ml-5 ">
            <h1>Add some friends!!</h1>
        </div>
    @endif




@endsection

