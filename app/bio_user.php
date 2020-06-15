<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class bio_user extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'users_id', 'bio', 'web',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'users_id','id');
    }
   
}