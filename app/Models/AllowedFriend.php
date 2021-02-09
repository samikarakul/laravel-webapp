<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllowedFriend extends Model
{
    use HasFactory;
    protected $fillable = [
        'request_sender_id',
        'user_id'
    ];
}
