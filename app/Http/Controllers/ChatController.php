<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChatPackageRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\chat_user;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class ChatController extends Controller
{
    public function show(Request $request, $username)
    {
        $yang_chat = DB::table('users')
        ->select('users.id','users.name','users.username','users.email','photo_profile_users.image_profile',DB::raw("count(chat_users.users_id) as count"))
        ->whereExists( function ($query){
            $query->select('chat_users.*')
                ->from('chat_users')
                ->where(function ($query1){
                    $query1->where('chat_users.users_id_send', '=', Auth::user()->id)
                            ->orwhere('chat_users.users_id', '=', Auth::user()->id);
                })
                ->where(function ($query2){
                    $query2 ->wherecolumn('chat_users.users_id','users.id')
                             ->orWherecolumn('chat_users.users_id_send','users.id');
                });
               
        })
        ->leftjoin('chat_users',function ($query3){
            $query3->on('chat_users.users_id','=','users.id')
                    ->where('chat_users.status','0')
                    ->where('chat_users.users_id_send', '=', Auth::user()->id)
                    ->orderBy('chat_users.created_at','ASC');
        })
        ->leftjoin('photo_profile_users','photo_profile_users.users_id','=','users.id')
        ->where('users.id','!=', Auth::user()->id)
        ->groupBy('users.id','photo_profile_users.image_profile','users.name','users.username','users.email')
        ->orderBy('count','DESC')
        ->get();

        $count_message = DB::table('chat_users')
        ->where('chat_users.users_id_send',Auth::user()->id)
        ->where('chat_users.status', '0')
        ->count();

        $untuk_foto_profile = User::with(['photo_profile'])->where('username', Auth::user()->username)
        ->firstOrFail();


        return view('pages.viewmessage',[
            'count_message' => $count_message,
            'yang_chat' => $yang_chat,
            'untuk_foto_profile' => $untuk_foto_profile,
        ]);
    }

    public function create($username,$id)
    {
        $untuk_foto_profile = User::with(['photo_profile'])->where('username', Auth::user()->username)
        ->firstOrFail();

        $count_message = DB::table('chat_users')
        ->where('chat_users.users_id_send',Auth::user()->id)
        ->where('chat_users.status', '0')
        ->count();

        $update = DB::table('chat_users')
                ->where('chat_users.users_id_send','=',Auth::user()->id)
                ->where('chat_users.users_id','=',$id)
                ->update(['chat_users.status' => '1'])
                ;

        $yang_chat = DB::table('users')
        ->select('users.id','users.name','users.username','users.email','photo_profile_users.image_profile',DB::raw("count(chat_users.users_id) as count"))
        ->whereExists( function ($query){
            $query->select('chat_users.*')
                ->from('chat_users')
                ->where(function ($query1){
                    $query1->where('chat_users.users_id_send', '=', Auth::user()->id)
                            ->orwhere('chat_users.users_id', '=', Auth::user()->id);
                })
                ->where(function ($query2){
                    $query2 ->wherecolumn('chat_users.users_id','users.id')
                             ->orWherecolumn('chat_users.users_id_send','users.id');
                });
               
        })
        ->leftjoin('chat_users',function ($query3){
            $query3->on('chat_users.users_id','=','users.id')
                    ->where('chat_users.status','0')
                    ->where('chat_users.users_id_send', '=', Auth::user()->id);
        })
        ->leftjoin('photo_profile_users','photo_profile_users.users_id','=','users.id')
        ->where('users.id','!=', Auth::user()->id)
         ->groupBy('users.id','photo_profile_users.image_profile','users.name','users.username','users.email')
         ->orderBy('count','DESC')
        ->get();

        $isi_chat = DB::table('chat_users')
        ->select('chat_users.*')
        ->where(function ($query){
            $query->where('chat_users.users_id', Auth::user()->id)
                ->orwhere('chat_users.users_id_send', Auth::user()->id);
        })
        ->where(function ($query1) use($id){
            $query1->where('chat_users.users_id', $id)
                ->orwhere('chat_users.users_id_send', $id);
        })
        ->get();

        $foto_user_yang_chat = DB::table('users')
                            ->select('users.id','users.name','users.username','photo_profile_users.image_profile')
                            ->leftjoin('photo_profile_users','photo_profile_users.users_id','=','users.id')                       
                            ->where('users.id','=', $id)
                            ->get();


        return view('pages.viewmessageuser',[
        'count_message' => $count_message,
        'isi_chat' => $isi_chat,
        'yang_chat' => $yang_chat,
        'foto_user_yang_chat' => $foto_user_yang_chat,
        'untuk_foto_profile'=>$untuk_foto_profile
        
        ]);
    }

    public function store(ChatPackageRequest $request, $users_id, $id)
    {
        $data = $request->all();
        $data['users_id'] = Auth::user()->id;
        $data['users_id_send'] = $id;
        chat_user::create($data);

        return redirect()->back();
    }
}
