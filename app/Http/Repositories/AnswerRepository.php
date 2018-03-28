<?php
/**
 * Created by PhpStorm.
 * User: sunhao
 * Date: 2018/3/1
 * Time: 16:13
 */

namespace App\Http\Repositories;


use App\Answer;
use App\Question;

class AnswerRepository
{
    public function createData(array $attributes)
    {
        return Answer::create($attributes);
    }

    public function byId($id)
    {
        return Answer::find($id);
    }
}