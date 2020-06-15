<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\follow_user;

class FollowController extends Controller
{
    public function follow($id)
    {
        $data['users_id'] = Auth::user()->id;
        $data['users_id_followed'] = $id;

        follow_user::create($data);
        return redirect()->back();
    }

    public function unfollow($users_id_followed)
    {
        $item = follow_user::where('users_id', Auth::user()->id)->where('users_id_followed',$users_id_followed)->firstOrFail();

        $item->delete();
        return redirect()->back();
    }
}
