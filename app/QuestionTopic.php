<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\QuestionTopic
 *
 * @property int $id
 * @property int $question_id
 * @property int $topic_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionTopic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionTopic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionTopic query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionTopic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionTopic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionTopic whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionTopic whereTopicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\QuestionTopic whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class QuestionTopic extends Model
{
    protected $table = 'question_topic';

    protected $fillable = ['question_id','topic_id'];
}
