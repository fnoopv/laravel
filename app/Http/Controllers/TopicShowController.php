<?php

namespace App\Http\Controllers;

use App\FavoriteTopic;
use App\Http\Requests\StoreTopicRequest;
use App\Question;
use App\QuestionTopic;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicShowController extends Controller
{

    public function index()
    {
        $topicId = FavoriteTopic::all()->where('user_id','=',Auth::id())->pluck('topic_id');
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
        return view('topic.index',compact(['topics','questions']));
    }

    public function edit($topic)
    {
        $top = Topic::find($topic);
        return view('topic.edit',compact('top'));
    }

    public function update(StoreTopicRequest $request,$topic)
    {
        $topics = Topic::find($topic);
        $topics->update([
            'name' => $request->get('name'),
            'bio' => $request->get('bio')
        ]);
        return redirect()->route('topics');
    }

    public function show($topic)
    {
        $questionId = QuestionTopic::where('topic_id','=',$topic)->pluck('question_id');
        $questions = array();

        for ($i=0;$i<count($questionId);$i++)
        {
            array_push($questions,Question::find($questionId[$i]));
        }

        $topics = Topic::find($topic);

        return view('topic.info',compact(['questions','topics']));
    }
}
