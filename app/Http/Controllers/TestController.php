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
use App\FavoriteTopic;
use App\Follow;
use App\Question;
use App\QuestionTopic;
use App\Topic;
use App\User;
use Illuminate\Http\Request;

class TestController
{

    protected $user,$question;

    /**
     * TestController constructor.
     * @param User $user
     * @param Question $question
     */
    public function __construct(User $user,Question $question)
    {
        $this->user = $user;
        $this->question = $question;
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function index()
    {
        return view('test.index');
    }

    public function show(Request $request)
    {
        return json_encode($request->get('date'));
    }
}