<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PhotoProfileRequest;
use App\User;
use App\photo_profile_user;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PhotoProfileController extends Controller
{
    public function store(PhotoProfileRequest $request, $username)
    {
        $data = $request->all();
        $data['users_id'] = Auth::user()->id;
        $data['image_profile'] = $request->file('image_profile')->store(
            'assets/gallery/profile', 'public'
        );
        photo_profile_user::create($data);

        return redirect()->route('profile', $username); 
    }

    public function update(PhotoProfileRequest $request, $username, $id)
    {
        $data = $request->all();
        $data['users_id'] = Auth::user()->id;
        $data['image_profile'] = $request->file('image_profile')->store(
            'assets/gallery/profile', 'public'
        );
        $item = photo_profile_user::findOrFail($id);
        
        $item->update($data);
        return redirect()->route('profile', $username); 
    }
}
