@extends('layouts.app')

@section('content')
    @if ($friends->count())
        @foreach($friends as $friend)
            @if($friend -> request_sender_id == auth()->user()->id)
                @foreach($users as $user)
                    @if($friend -> user_id == $user -> id)
                        <div class="max-w-xs rounded overflow-hidden shadow-lg my-2 ml-5 ">
                            <img class="w-full" src="https://vignette.wikia.nocookie.net/animepedia/images/c/ca/412-4.png/revision/latest/scale-to-width-down/340?cb=20180220090903&path-prefix=tr" alt="Sunset in the mountains">
                            <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2">{{ $user -> name }}</div>
                                <div class="font-bold text-xl mb-2">{{ $user -> id }}</div>
                            </div>
                            <div class="px-6 py-4">
                                <button class="bg-green-600 rounded-xl"><p class="p-3">Send Message</p></button>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        @endforeach
    @else
        <div class="max-w-xs rounded overflow-hidden shadow-lg my-2 ml-5 ">
            <img class="w-full" src="https://vignette.wikia.nocookie.net/animepedia/images/c/ca/412-4.png/revision/latest/scale-to-width-down/340?cb=20180220090903&path-prefix=tr" alt="Sunset in the mountains">
            <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">Bu else içi</div>

            </div>
            <div class="px-6 py-4">
                <button class="bg-green-600 rounded-xl"><p class="p-3">Send Message</p></button>
            </div>
        </div>
    @endif




@endsection

