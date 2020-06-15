<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatusRequest;
use App\status_user;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatusController extends Controller
{
    

    public function create()
    {
        $untuk_foto_profile = User::with(['photo_profile'])->where('username', Auth::user()->username)
        ->firstOrFail();
        return view('pages.makestatus',[
        'untuk_foto_profile'=>$untuk_foto_profile]);
    }

    public function store(StatusRequest $request)
    {
        $data = $request->all();
        $data['users_id'] = Auth::user()->id;
        status_user::create($data);
        return redirect('/status');
    }

    public function edit($username,$id)
    {
        $untuk_foto_profile = User::with(['photo_profile'])->where('username', Auth::user()->username)
        ->firstOrFail();
        $item = status_user::findOrFail($id);
        $count_message = DB::table('chat_users')
        ->where('chat_users.users_id_send',Auth::user()->id)
        ->where('chat_users.status', '0')
        ->count();

        if(Auth::user()->id == $item['users_id'])
        {
        return view('pages.editstatus',[
            'count_message' => $count_message,
            'item' => $item,
            'untuk_foto_profile' => $untuk_foto_profile
        ]);
        }
        else
        {
        return redirect('/');
        }
    }

    public function update(StatusRequest $request, $username,$id)
    {
        $data = $request->all();
        $data['users_id'] = Auth::user()->id;
        $item = status_user::findOrFail($id);
        
        $item->update($data);
        return redirect()->route('statusprofile', $username);   
    }

    public function destroy($username, $id)
    {
        $item = status_user::findOrFail($id);
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
