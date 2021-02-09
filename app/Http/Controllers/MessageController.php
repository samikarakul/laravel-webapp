<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\Friend;
use App\Models\AllowedFriend;


class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        $friends = Friend::all();
        $allowedfriends = AllowedFriend::all();

        $users = User::all();
        return view("users.messages.index",[
            'messages' => $messages,
            'friends' =>  $friends,
            'allowedfriends' =>  $allowedfriends,
            'users' => $users
        ]);
    }
    public function userMsg(User $user)
    {
        $messages = Message::all();
        $friends = Friend::all();
        $allowedfriends = AllowedFriend::all();
        $users = User::all();

        return view("users.messages.userMsg",[
            'messages' => $messages,
            'friends' =>  $friends,
            'allowedfriends' =>  $allowedfriends,
            'users' => $users,
            'userM' => $user
        ]);
    }

    public function userMsgStore(User $user, Request $request)
    {
        $message = new Message();
        $message -> message_sender_id = auth()->user() -> id;
        $message -> user_id = $user->id;
        $message -> message_body = $request -> content;
        $message -> save();

        return back();
    }
}
