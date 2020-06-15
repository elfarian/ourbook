<?php

namespace App;

use App\User;
use App\photo_profile_user;
use App\post_photo_user;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;


class follow_user extends Model
{
    protected $fillable = [
        'users_id', 'users_id_followed',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'users_id_followed','id');
        //return $this->hasManyThrough('App\User', 'App\Kecamatan');
    }

    public function user_photo_profile(){
        return $this->belongsTo(photo_profile_user::class, 'users_id_followed','id');
        //return $this->hasManyThrough('App\User', 'App\Kecamatan');
    }

    public function post_photo_follow(){
       // users_id_followed = users_id_followed , Auth::user()->id;
        return $this->hasMany(post_photo_user::class, 'users_id','users_id_followed')
        ->orderBy('post_photo_users.created_at', 'DESC')
        ->latest();
        
    }
}
