<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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

    public function edit($user)
    {
        $user = User::find($user);
        return view('user/edit',compact('user'));
    }

    public function update(Request $request)
    {
        $date = $request->get('birthday');
        $datas = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'sex' => $request->get('sex'),
            'age' => $request->get('age'),
            'birthday' => ,
            'url' => $request->get('url'),
            'sign' => $request->get('sign'),
            'phone' => $request->get('phone')
        ];
        foreach ($datas as $data)
        {
            if (empty($data))
            {
                unset($data);
            }
        }
        $status = Profile::where('user_id',"=",Auth::id())->update($datas);
        if ($status)
        {
            return "hello";
        }
    }
}
