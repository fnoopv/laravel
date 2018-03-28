<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function guest($user)
    {
        $user = User::find($user);
        return view('user.guest',compact('user'));
    }

    public function admin($user)
    {
        $public  = User::find($user);
        $private = Profile::where('user_id',$user);
        return view('user.admin',compact(['public','private']));
    }
}
