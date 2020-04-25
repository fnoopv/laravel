<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Follow
 *
 * @property int $id
 * @property int $user_id
 * @property int $question_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow whereUserId($value)
 * @mixin \Eloquent
 */
class Follow extends Model
{
    protected $table = 'user_question';

    protected $fillable = ['user_id','question_id'];
}
