<?php
/**
 * Created by PhpStorm.
 * User: sunhao
 * Date: 2018/2/27
 * Time: 17:49
 */

namespace App\Repositories;

use App\Question;

/**
 * Class QuestionRepository
 * @package App\Repositories
 */
class QuestionRepository
{
    protected $question;
    public function _construct(Question $question)
    {
        $this->question = $question;
    }
    /**
     * @param $id
     * @return mixed
     */
    public function byIdWithTopics($id)
    {
        return $this->question::where('id',$id)->with('topics')->first();
    }

    public function create(array $attributes)
    {
        return $this->question::create($attributes);
    }
}