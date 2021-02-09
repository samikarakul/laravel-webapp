<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Posty</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/yeni_app.css') }}">
  </head>
  <body class="bg-gray-200">

    <nav class="p-6 bg-white flex justify-between mb-6">
        <ul class="flex items-center">
            <li>
                <a href="/" class="p-3">Home</a>
            </li>
            <li>
                <a href="{{ route('dashboard') }}" class="p-3">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('posts') }}" class="p-3">Post</a>
            </li>
        </ul>

        <ul class="flex items-center">
            @auth
                <li>
                    <a href="{{ route('messages') }}" class="p-3">Messages</a>
                </li>
                <li>
                    <a href="{{ route('users.allowedfriends') }}" class="p-3">Allowed Friends</a>
                </li>
                <li>
                    <a href="{{ route('users.friends') }}" class="p-3">Friends</a>
                </li>
                <li>
                    <a href="{{ route('users.posts', auth()->user()) }}" class="p-3">{{ auth()->user()->name }}</a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="p-3 inline">
                        @csrf
                        <button type="submit">logout</button>
                    </form>
                </li>
            @endauth

            @guest
                <li>
                <a href="{{ route('login') }}" class="p-3">login</a>
                </li>
                <li>
                    <a href="{{ route('register') }}" class="p-3">Register</a>
                </li>
            @endguest


        </ul>
    </nav>

    @yield('content')

  </body>
</html>
