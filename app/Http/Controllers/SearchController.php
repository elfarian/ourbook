<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $untuk_foto_profile = User::with(['photo_profile'])->where('id', Auth::user()->id)
        ->firstOrFail();

        $count_message = DB::table('chat_users')
        ->where('chat_users.users_id_send',Auth::user()->id)
        ->where('chat_users.status', '0')
        ->count();

        $searchtoken = $request->search;

        $search = DB::table('users')
                ->select('users.id','users.username','users.name','photo_profile_users.image_profile')
                ->where(function ($query) use($searchtoken){
                    $query->where('users.name','like',"%".$searchtoken."%")
                    ->orwhere('users.username','like',"%".$searchtoken."%");
                })
                ->leftjoin('photo_profile_users','photo_profile_users.users_id','=','users.id')
                ->where('users.id','!=', Auth::user()->id)
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
        if($searchtoken != NULL){
        return view('pages.search',[
            'count_message' => $count_message,
            'searchtoken' => $searchtoken,
            'request' => $request,
            'search' => $search,
            'untuk_foto_profile'=>$untuk_foto_profile,
        ]);
        }else{
        return redirect()->back();
        }
    }
}