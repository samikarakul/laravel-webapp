<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Post;

class PostLiked extends Mailable
{
    use Queueable, SerializesModels;

    public $liker;
    public $post;
    public $new_request;


    /**
     * Create a new message instance.
     *
     * @return void
     */

    // public function __construct(User $liker, Post $post)
    // {
    //     $this->liker = $liker;
    //     $this->post = $post;
    // }

    public function __construct(Request $request)
    {
        $this->new_request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.posts.post_liked')
                ->subject("Someone liked your post!!");
    }
}
