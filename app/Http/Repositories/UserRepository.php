<?php
/**
 * Created by PhpStorm.
 * User: sunhao
 * Date: 2018/3/5
 * Time: 14:26
 */

namespace App\Http\Repositories;


use App\User;

class UserRepository
{
    public function byId($id)
    {
        return User::find($id);
    }
}