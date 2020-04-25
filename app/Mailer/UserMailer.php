<?php
/**
 * Created by PhpStorm.
 * User: sunhao
 * Date: 2018/3/5
 * Time: 17:24
 */

namespace App\Mailer;


use App\User;
use Auth;

class UserMailer extends Mailer
{
    public function followNotifyEmail($email)
    {
        $data = [
            'url' => url('http://talk.test'),
            'name' => Auth::guard('api')->user()->name,
        ];

        $this->sendTo('user_follow_notifications',$email,$data);
    }

    public function passwordReset($email,$token)
    {
        $data = [
            'url' => url('password/reset',$token),
        ];

        $this->sendTo('zhihu_app_password_reset',$email,$data);
    }

    public function registerMailer(User $user)
    {
        $data = [
            'url' => route('email.verify',['token' => $user->confirmation_token]),
            'name' => $user->name,
        ];

        $this->sendTo('zhihu_app_register',$user->email,$data);
    }
}