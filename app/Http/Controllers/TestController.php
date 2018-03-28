<?php
/**
 * Created by PhpStorm.
 * User: sunhao
 * Date: 2018/3/27
 * Time: 10:33
 */

namespace App\Http\Controllers;

use App\Answer;
use App\Favorite;
use App\Follow;
use App\Question;
use App\User;

class TestController
{

    protected $user;

    /**
     * TestController constructor.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * @return mixed
     */
    public function index()
    {
        $user = User::find(5)->followersUser()->where('follower_id','=',5)->pluck('followed_id');
        $users = array();
        for ($i=0;$i<count($user);$i++)
        {
            array_push($users,User::where('id','=',$user[$i])->get());
        }
        return $users;
    }
}