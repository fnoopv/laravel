<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Answer
 *
 * @property int $id
 * @property int $user_id
 * @property int $question_id
 * @property string $body
 * @property int $votes_count
 * @property-read int|null $comments_count
 * @property int $is_hidden
 * @property int $close_hidden
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read \App\Question $question
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Answer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Answer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Answer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Answer whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Answer whereCloseHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Answer whereCommentsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Answer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Answer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Answer whereIsHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Answer whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Answer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Answer whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Answer whereVotesCount($value)
 * @mixin \Eloquent
 */
class Answer extends Model
{
    protected $fillable = ['user_id','question_id','body'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function comments()
    {
        return $this->morphMany('App\Comment','commentable');
    }
}
