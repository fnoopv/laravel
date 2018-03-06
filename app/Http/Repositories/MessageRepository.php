<?php
/**
 * Created by PhpStorm.
 * User: sunhao
 * Date: 2018/3/6
 * Time: 9:57
 */

namespace App\Http\Repositories;


use App\Message;

class MessageRepository
{
    public function create(array $arrtibutes)
    {
        return Message::create($arrtibutes);
    }
}