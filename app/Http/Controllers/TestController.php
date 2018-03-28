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
        $question = array_unique(Answer::where('user_id','=',5)->pluck('question_id')->toArray());
        $questionId = array();
        foreach ($question as $key => $value)
        {
            array_push($questionId,$value);
        }
        $use = array();
        for ($i=0;$i<count($questionId);$i++)
        {
            array_push($use,Question::where('id','=',$questionId[$i])->get());
        }
        foreach ($use as $value)
        {
            foreach ($value as $item)
            {
                echo $item->id;
            }
        }
//        return $use[1];
    }
}