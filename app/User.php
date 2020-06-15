<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function status(){
        return $this->hasMany(status_user::class, 'users_id','id');
    }

    public function bio(){
        return $this->hasMany(bio_user::class, 'users_id','id');
    }

    public function photo_profile(){
        return $this->hasMany(photo_profile_user::class, 'users_id','id');
    }

    public function banner_profile(){
        return $this->hasMany(banner_profile_user::class, 'users_id','id');
    }

    public function post_photo(){
        return $this->hasMany(post_photo_user::class, 'users_id','id');
    }

    public function follow_user(){
        return $this->hasMany(follow_user::class, 'users_id','id');
    }

    public function followed_user(){
        return $this->hasMany(follow_user::class, 'users_id_followed','id');
    }
}
