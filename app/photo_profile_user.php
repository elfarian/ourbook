<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class photo_profile_user extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'users_id', 'image_profile',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'users_id','id');
    }
}
