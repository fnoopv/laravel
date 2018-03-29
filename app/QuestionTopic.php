<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionTopic extends Model
{
    protected $table = 'question_topic';

    protected $fillable = ['question_id','topic_id'];
}
