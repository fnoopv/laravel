<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserCenterController extends Controller
{
    protected $user;

    /**
     * UserCenterController constructor.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function guest($user)
    {
        $user = $this->user->find($user);
        return view('user.guest',compact('user'));
    }

    public function admin($user)
    {
        $user = $this->user->find($user);

        return view('user.admin',compact('user'));
    }
}
