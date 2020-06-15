<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\status_user;
use App\follow_user;
use App\post_photo_user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index(Request $request, $username)
    { 
        $items = User::with(['bio', 'photo_profile','post_photo','followed_user','follow_user'])
                ->where('username', $username)
                ->firstOrFail();

        if(Auth::check()){
        $untuk_foto_profile = User::with(['photo_profile'])->where('username', Auth::user()->username)
        ->firstOrFail();
        $cekfollow = DB::table('follow_users')
                    ->join('users','users.id','=','follow_users.users_id_followed')
                    ->where('users_id', Auth::user()->id)
                    ->where('users_id_followed',$items->id)
                    ->get();
         $count_message = DB::table('chat_users')
        ->where('chat_users.users_id_send',Auth::user()->id)
        ->where('chat_users.status', '0')
        ->count();
        }
        else{
        $count_message = '';
        $untuk_foto_profile='';
        $cekfollow='';
        }

        $untuk_banner_profile = User::with(['banner_profile'])->where('username', $username)
        ->firstOrFail();
        
         $followersnya = DB::table('follow_users')
                        ->leftjoin('photo_profile_users','photo_profile_users.users_id','=','follow_users.users_id')
                        ->join('users','users.id','=','follow_users.users_id')
                        ->select('users.username','photo_profile_users.*')
                        ->where('follow_users.users_id_followed', $items->id)
                        ->orderBy('follow_users.created_at','DESC')
                        ->get();
        
        $followingnya = DB::table('follow_users')
                        ->leftjoin('photo_profile_users','photo_profile_users.users_id','=','follow_users.users_id_followed')
                        ->join('users','users.id','=','follow_users.users_id_followed')
                        ->select('users.username','photo_profile_users.*')
                        ->where('follow_users.users_id', $items->id)
                        ->orderBy('follow_users.created_at','DESC')
                        ->get();

        return view('pages.profile', [
        'followersnya' => $followersnya,
        'followingnya' => $followingnya,
        'count_message' => $count_message,
        'cekfollow' => $cekfollow,
        'items' => $items,
        'untuk_foto_profile' => $untuk_foto_profile,
        'untuk_banner_profile' => $untuk_banner_profile,
        'count_status' => status_user::where('users_id', $items['id'])->count(),
        'count_photo' => post_photo_user::where('users_id', $items['id'])->count(),
        'count_followers' => follow_user::where('users_id_followed', $items['id'])->count(),
        'count_following' => follow_user::where('users_id', $items['id'])->count(),
        ]);
    }

    public function show(Request $request, $username)
    {
        $items = User::with(['status', 'photo_profile'])->where('username', $username)   
                ->firstOrFail();
         if(Auth::check()){
        $untuk_foto_profile = User::with(['photo_profile'])->where('username', Auth::user()->username)
                 ->firstOrFail();
         $count_message = DB::table('chat_users')
        ->where('chat_users.users_id_send',Auth::user()->id)
        ->where('chat_users.status', '0')
        ->count();

        $cekfollow = DB::table('follow_users')
        ->join('users','users.id','=','follow_users.users_id_followed')
        ->where('users_id', Auth::user()->id)
        ->where('users_id_followed',$items->id)
        ->get();
        }else{
        $untuk_foto_profile='';
        $count_message='';
        $cekfollow = '';
        }
        $untuk_banner_profile = User::with(['banner_profile'])->where('username', $username)
        ->firstOrFail();

         $followersnya = DB::table('follow_users')
                        ->leftjoin('photo_profile_users','photo_profile_users.users_id','=','follow_users.users_id')
                        ->join('users','users.id','=','follow_users.users_id')
                        ->select('users.username','photo_profile_users.*')
                        ->where('follow_users.users_id_followed', $items->id)
                        ->orderBy('follow_users.created_at','DESC')
                        ->get();
        
        $followingnya = DB::table('follow_users')
                        ->leftjoin('photo_profile_users','photo_profile_users.users_id','=','follow_users.users_id_followed')
                        ->join('users','users.id','=','follow_users.users_id_followed')
                        ->select('users.username','photo_profile_users.*')
                        ->where('follow_users.users_id', $items->id)
                        ->orderBy('follow_users.created_at','DESC')
                        ->get();

        return view('pages.profilestatus',[
            'followersnya' => $followersnya,
            'followingnya' => $followingnya,
            'count_message' => $count_message,
            'cekfollow' => $cekfollow,
            'items' => $items,
            'untuk_foto_profile' => $untuk_foto_profile,
            'untuk_banner_profile' => $untuk_banner_profile,
            'count_status' => status_user::where('users_id', $items['id']) ->count(),
            'count_photo' => post_photo_user::where('users_id', $items['id'])->count(),
            'count_followers' => follow_user::where('users_id_followed', $items['id'])->count(),
        'count_following' => follow_user::where('users_id', $items['id'])->count(),
        ]);
    }
}
