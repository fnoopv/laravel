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
        return view('user.admin',compact('public','private'));
    }

    public function edit($user)
    {
        $user = User::find($user);
        return view('user.edit',compact('user'));
    }

    /**
     * @param Request $request
     * @param $user
     * @return string
     */
    public function update(Request $request, $user)
    {
        if (strlen($request->get('phone')) == 11)
        {
            $phone = substr($request->get('phone'),0,3)." ".substr($request->get('phone'),3,4)." ".substr($request->get('phone'),7,4);
        }else {
            $phone = $request->get('phone');
        }
        $data = [
            'sex' => $request->get('sex'),
            'age' => $request->get('age'),
            'birthday' => $request->get('birthday'),
            'url' => $request->get('url'),
            'sign' => $request->get('sign'),
            'phone' => $phone
        ];
        $userToUpdate = User::all()->find($user);
        $userToUpdate->profiles()->update($data);
        $userToUpdate->update([
            'name' => $request->get('name'),
            'email' => $request->get('email')
        ]);

        flash('修改成功')->success();
        return back();
    }
}
