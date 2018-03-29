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
     * @return mixed
     */
    public function index()
    {
        $topicId = FavoriteTopic::all()->where('user_id','=',5)->pluck('topic_id');
        $topics = array();
        for ($i=0;$i<count($topicId);$i++)
        {
            array_push($topics,Topic::find($topicId[$i]));
        }
        $questions = array();
        for ($i=0;$i<count($topicId);$i++)
        {
            array_push($questions,Question::find(QuestionTopic::where('topic_id','=',$topicId[$i])->pluck('question_id')));
        }
        return $questions;
    }

    public function other()
    {
//        @foreach($topics as $topic)
//            <div class="card" style="margin-bottom: 1rem">
//                <h5 class="card-header">
//                    <a href="/topic/{{ $topic->id }}" style="font-weight: bold">{{ $topic->name }}</a>
//                    <span style="font-size: 14px;font-weight: 400;">热度{{ $topic->questions_count }}</span>
//                    <a class="btn pull-right" href="/topic/edit/{{ $topic->id }}">编辑</a>
//                </h5>
//                <div class="card-body">
//                    <p class="card-text">{{ $topic->bio }}</p>
//                </div>
//            </div>
//    @endforeach
    }
}