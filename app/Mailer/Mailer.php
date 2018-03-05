<?php
/**
 * Created by PhpStorm.
 * User: sunhao
 * Date: 2018/3/5
 * Time: 17:21
 */

namespace App\Mailer;

use Mail;
use Naux\Mail\SendCloudTemplate;

class Mailer
{
    protected function sendTo($template,$email,array $data)
    {
        $content = new SendCloudTemplate($template, $data);

        Mail::raw($content, function ($message) use ($email) {
            $message->from('fnoop@foxmail.com', 'One');

            $message->to($email);
        });
    }
}