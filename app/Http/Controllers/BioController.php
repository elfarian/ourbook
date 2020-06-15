<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BioRequest;
use App\User;
use App\bio_user;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BioController extends Controller
{
    public function index()
    {
        
    }

    public function create()
    {
        $untuk_foto_profile = User::with(['photo_profile'])->where('username', Auth::user()->username)
        ->firstOrFail();
        $count_message = DB::table('chat_users')
        ->where('chat_users.users_id_send',Auth::user()->id)
        ->where('chat_users.status', '0')
        ->count();

        return view('pages.bio.create',[
            'count_message' => $count_message,
            'untuk_foto_profile' => $untuk_foto_profile,
        ]);
    }
    
    public function store(BioRequest $request, $username)
    {
        $data = $request->all();
        $data['users_id'] = Auth::user()->id;
        bio_user::create($data);

        return redirect()->route('profile', $username); 
    }

    public function edit($username)
    {
        $items = User::with(['bio','photo_profile'])->findOrFail(Auth::user()->id);
        $untuk_foto_profile = User::with(['photo_profile'])->where('username', Auth::user()->username)
        ->firstOrFail();
        $count_message = DB::table('chat_users')
        ->where('chat_users.users_id_send',Auth::user()->id)
        ->where('chat_users.status', '0')
        ->count();
             return view('pages.updatebio',[
                 'count_message' => $count_message,
                'items' => $items,
                'untuk_foto_profile' => $untuk_foto_profile
         ]);         
    }

    public function update(BioRequest $request, $username)
    {
        $data = $request->all();
        $data['users_id'] = Auth::user()->id;
        $item = bio_user::findOrFail(Auth::user()->id);
       
        $item->update($data);
        return redirect()->route('statusprofile', $username);

    }

   
}
