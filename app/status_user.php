<?php

namespace App;

use App\photo_profile_user;
use App\follow_user;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class status_user extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'users_id', 'status', 'type_status',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'users_id','id');
    }

    public function user_photo_profile(){
        return $this->hasMany(photo_profile_user::class, 'users_id','id');
        //return $this->hasManyThrough('App\User', 'App\Kecamatan');
    }

    public function post_status_follow(){
        return $this->hasMany(follow_user::class, 'users_id','users_id_followed')
        ->orderBy('status_users.created_at', 'DESC')->all()
      ;
    }
   
}
