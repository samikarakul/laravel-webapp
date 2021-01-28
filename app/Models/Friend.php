<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Friend extends Model
{
    use HasFactory;
    protected $fillable = [
        'request_sender_id',
        'user_id'
    ];

    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }
}
