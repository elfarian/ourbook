<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class banner_profile_user extends Model
{
    protected $fillable = [
        'users_id', 'banner_profile',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'users_id','id');
    }
}
