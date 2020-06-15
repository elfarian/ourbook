<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $fotos = DB::table('post_photo_users')
        
        ->whereIn('post_photo_users.users_id', function ($query){
            $query->select('follow_users.users_id_followed')
            ->from('follow_users')
            ->where('follow_users.users_id','=', Auth::user()->id)
            ->whereNull('post_photo_users.deleted_at');
        })
        ->orwhereIn('post_photo_users.users_id',[Auth::user()->id])
        ->leftjoin('photo_profile_users','photo_profile_users.users_id','=','post_photo_users.users_id')
        ->join('users','users.id','=','post_photo_users.users_id')
        ->select('users.username','post_photo_users.*','photo_profile_users.image_profile')
        ->whereNull('post_photo_users.deleted_at')
        ->orderBy('post_photo_users.updated_at','DESC')
        ->get();

        $request = DB::table('users')
                    ->whereNotExists( function ($query){
                        $query->select('follow_users.*')
                        ->from('follow_users')
                        ->where('follow_users.users_id','=', Auth::user()->id)
                        ->where(function ($query1){
                            $query1->wherecolumn('follow_users.users_id', 'users.id')
                                    ->orwherecolumn('follow_users.users_id_followed', 'users.id');
                        });
                    })
                    ->leftjoin('photo_profile_users','photo_profile_users.users_id','=','users.id')
                    ->select('users.id','users.username','photo_profile_users.image_profile')
                    ->where('users.id','!=', Auth::user()->id)
                    ->inRandomOrder()
                    ->limit(3)
                    ->get();

         $untuk_foto_profile = User::with(['photo_profile'])->where('id', Auth::user()->id)
        ->firstOrFail();

        $count_message = DB::table('chat_users')
                        ->where('chat_users.users_id_send',Auth::user()->id)
                        ->where('chat_users.status', '0')
                        ->count();

        return view('pages.dashboard',[
            'count_message' => $count_message,
            'request' => $request,
            'fotos' => $fotos,
            'untuk_foto_profile'=>$untuk_foto_profile,
            ]);
    }

    public function show(Request $request)
    {
        $untuk_foto_profile = User::with(['photo_profile'])->where('id', Auth::user()->id)
        ->firstOrFail();

        $request = DB::table('users')
        ->whereNotExists( function ($query){
            $query->select('follow_users.*')
            ->from('follow_users')
            ->where('follow_users.users_id','=', Auth::user()->id)
            ->where(function ($query1){
                $query1->wherecolumn('follow_users.users_id', 'users.id')
                        ->orwherecolumn('follow_users.users_id_followed', 'users.id');
            });
        })
        ->leftjoin('photo_profile_users','photo_profile_users.users_id','=','users.id')
        ->select('users.id','users.username','photo_profile_users.image_profile')
        ->where('users.id','!=', Auth::user()->id)
        ->inRandomOrder()
        ->limit(3)
        ->get();

        $status = DB::table('status_users')
                  ->leftjoin('photo_profile_users','photo_profile_users.users_id','=','status_users.users_id')
                  ->join('users','users.id','=','status_users.users_id')
                  ->select('users.username','status_users.*','photo_profile_users.image_profile')
                  ->whereIn('status_users.users_id', function ($query){
                    $query->select('follow_users.users_id_followed')
                    ->from('follow_users')
                    ->where('follow_users.users_id','=', Auth::user()->id)
                    ;
                })
                ->orwhereIn('status_users.users_id',[Auth::user()->id])
                  ->where('status_users.type_status', 'PUBLIC')
                  ->whereNull('status_users.deleted_at')
                  ->orderBy('status_users.updated_at','DESC')
                  ->get();

    $count_message = DB::table('chat_users')
                  ->where('chat_users.users_id_send',Auth::user()->id)
                  ->where('chat_users.status', '0')
                  ->count();

        return view('pages.status',[
            'count_message' => $count_message,
            'request' => $request,
            'status' => $status,
            'untuk_foto_profile'=>$untuk_foto_profile,
        ]);
    }
}
