<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BannerProfileRequest;
use App\User;
use App\banner_profile_user;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class BannerProfileController extends Controller
{
    public function store(BannerProfileRequest $request, $username)
    {
        $data = $request->all();
        $data['users_id'] = Auth::user()->id;
        $data['banner_profile'] = $request->file('banner_profile')->store(
            'assets/gallery/banner', 'public'
        );
        banner_profile_user::create($data);

        return redirect()->route('profile', $username); 
    }

    public function update(BannerProfileRequest $request, $username, $id)
    {
        $data = $request->all();
        $data['users_id'] = Auth::user()->id;
        $data['banner_profile'] = $request->file('banner_profile')->store(
            'assets/gallery/banner', 'public'
        );
        $item = banner_profile_user::findOrFail($id);
        
        $item->update($data);
        
        return redirect()->route('profile', $username);    
    }
}
