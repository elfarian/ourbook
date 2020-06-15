<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SettingRequest;
use App\Http\Requests\SettingUsernameRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function view()
    {
        $untuk_foto_profile = User::with(['photo_profile'])->where('username', Auth::user()->username)
        ->firstOrFail();

        $count_message = DB::table('chat_users')
        ->where('chat_users.users_id_send',Auth::user()->id)
        ->where('chat_users.status', '0')
        ->count();

        return view('pages.setting',[
        'count_message' => $count_message,
        'untuk_foto_profile'=>$untuk_foto_profile]);
    }

    public function show()
    {
        $count_message = DB::table('chat_users')
        ->where('chat_users.users_id_send',Auth::user()->id)
        ->where('chat_users.status', '0')
        ->count();

        $untuk_foto_profile = User::with(['photo_profile'])->where('username', Auth::user()->username)
        ->firstOrFail();

        return view('pages.settingUsername',[
        'count_message' => $count_message,
        'untuk_foto_profile'=>$untuk_foto_profile]);
    }

    public function updateName(SettingRequest $request)
    {
        $data = $request->all();
        $item = DB::table('users')
                ->where('users.id','=',Auth::user()->id)
                ->update(['users.name' => $data['name']])
                ;
        
        return redirect()->back();
    }

    public function updateUsername(SettingUsernameRequest $request)
    {
        $data = $request->all();
        $item = DB::table('users')
                ->where('users.id','=',Auth::user()->id)
                ->update(['users.username' => $data['username']])
                ;
        
        return redirect()->back();
    }
    
    public function settingpassword()
    {
        $count_message = DB::table('chat_users')
        ->where('chat_users.users_id_send',Auth::user()->id)
        ->where('chat_users.status', '0')
        ->count();

        $untuk_foto_profile = User::with(['photo_profile'])->where('username', Auth::user()->username)
        ->firstOrFail();

        return view('pages.settingPassword',[
        'count_message' => $count_message,
        'untuk_foto_profile'=>$untuk_foto_profile]);
    }
         
    public function changePassword(Request $request){
 
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
        // The passwords matches
        return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
         
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
        //Current password and new password are same
        return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        if(!(strcmp($request->get('new-password'), $request->get('new-password-confirm'))) == 0){
                    //New password and confirm password are not same
                    return redirect()->back()->with("error","New Password should be same as your confirmed password. Please retype new password.");
        }
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
         
        return redirect()->back()->with("success","Password changed successfully !");
         
        }
}
