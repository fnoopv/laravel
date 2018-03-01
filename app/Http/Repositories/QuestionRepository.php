<?php
/**
 * Created by PhpStorm.
 * User: sunhao
 * Date: 2018/3/1
 * Time: 16:38
 */

namespace App\Http\Repositories;


use App\Question;
use App\Topic;

class QuestionRepository
{
    /**
     * @return mixed
     */
    public function getQuestionsFeed()
    {
        return Question::latest('updated_at')->published()->with('user')->get();
    }

    /**
     * @param array $attibute
     * @return mixed
     */
    public function createData(array $attibute)
    {
        return Question::create($attibute);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function byIdWithTopicsAndAnswers($id)
    {
        return Question::where('id',$id)->with(['topics','answers'])->first();
    }

    /**
     * @param array $topics
     * @return array
     */
    public function nomallizeTopic(array $topics)
    {
        return collect($topics)->map(function ($topic){
            if (is_numeric($topic)) {
                Topic::find($topic)->increment('questions_count');
                return (int) $topic;
            }
            $newTopic = Topic::create(['name' => $topic,'questions_count'=>1]);

            return $newTopic->id;
        })->toArray();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function byId($id)
    {
        return Question::find($id);
    }
}