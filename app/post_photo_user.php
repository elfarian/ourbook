<?php

namespace App;

use App\User;
use App\photo_profile_user;
use App\follow_user;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class post_photo_user extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'users_id', 'post_photo', 'caption'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'users_id','id');
    }

    public function user_photo_profile(){
        return $this->belongsTo(photo_profile_user::class, 'users_id','id');
        //return $this->hasManyThrough('App\User', 'App\Kecamatan');
    }

    public function post_photo_follow(){
        return $this->hasMany(follow_user::class, 'users_id','users_id_followed')
        ->orderBy('post_photo_users.created_at', 'DESC')->all()
      ;
    }
}
