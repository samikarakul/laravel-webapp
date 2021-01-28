@extends('layouts.app')

@section('content')
<div class="relative">
    <div class="flex flex-row pr-5 pl-5">
        <div class="flex-auto">
            <ul>
                @foreach($friends as $friend)
                    @foreach($users as $user)
                        @if($user -> id == $friend-> user_id and $friend->request_sender_id == auth()->user()->id)
                            <div style="height:100px;" class="bg-green-300 w-full">
                                <li style="margin-left:10%;" class="mt-2">
                                    <a href="{{ route('users.messages', $user) }}" class="userM" class="bg-gray-100" value="{{$user->id}}" >{{$user -> username}}</a>
                                </li>
                            </div>

                        @endif
                    @endforeach
                @endforeach
            </ul>
        </div>
        {{-- <script>
            function showMsgs()
            {
                var comun = document.getElementsByClassName("userM");
                for (const child of comun) {
                    child.addEventListener("click", yaz)
                }
            }
            function yaz(e) {

                console.log(e.target.value)
            }
        </script> --}}
        <div class="flex-auto ml-5">
           <h1 style="margin-left: 50%; margin-top:30%;">Ask your friends how they are.</h1>
        </div>
    </div>

    <footer class="fixed pt-5 mr-5 bg-gray-200  border-2 border-gray-300" style="right:0; bottom:0; width:50%;">
        <form action="" method="POST" class="mt-3" enctype="multipart/form-data">
            @csrf
            <div class="mb-4 flex flex-row ml-4">
                <label for="content" class="sr-only">Write a message..</label>
                <textarea name="content" id="content" cols="30" rows="4" class="bg-gray-100
                border-2 w-10/12 p-4 rounded-lg  @error('content') border-red-500 @enderror"
                placeholder="Post Something!!"></textarea>
                @error('content')
                    <div class="text-red-500 mt-2 text-sm">
                        {{  }}
                    </div>
                @enderror

                <div class="mt-5 ml-5">
                    <button type="submit" class="bg-gray-400 text-white px-4 py-1 rounded font-medium mt-1">Send</button>
                <div>
            </div>

        </form>
    </footer>
</div>


@endsection

