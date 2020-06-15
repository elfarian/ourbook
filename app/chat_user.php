<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chat_user extends Model
{
    //
    protected $fillable = [
        'users_id', 'users_id_send', 'chat'
    ];
}
