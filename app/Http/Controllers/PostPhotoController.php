<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostPhotoRequest;
use App\User;
use App\post_photo_user;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostPhotoController extends Controller
{
    public function store(PostPhotoRequest $request, $username)
    {
        $data = $request->all();
        $data['users_id'] = Auth::user()->id;
        $data['post_photo'] = $request->file('post_photo')->store(
            'assets/gallery/post_photo', 'public'
        );
        post_photo_user::create($data);

        return redirect()->back();
    }
     public function destroy($username, $id)
    {
        $item = post_photo_user::findOrFail($id);
        if(Auth::user()->id == $item['users_id'])
        {
        $item->delete();
        return redirect()->back();
        }
        else
        {
        return redirect('/');  
        }
    }
}
