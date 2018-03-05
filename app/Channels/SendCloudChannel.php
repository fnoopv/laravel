<?php
/**
 * Created by PhpStorm.
 * User: sunhao
 * Date: 2018/3/5
 * Time: 16:01
 */

namespace App\Channels;


use Illuminate\Notifications\Notification;

class SendCloudChannel
{
    public function send($notifiable,Notification $notification)
    {
        $messages = $notification->toSendcloud($notifiable);
    }
}