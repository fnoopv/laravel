<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Topic
 *
 * @property int $id
 * @property string $name
 * @property string|null $bio
 * @property-read int|null $questions_count
 * @property int $followers_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Question[] $questions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Topic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Topic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Topic query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Topic whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Topic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Topic whereFollowersCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Topic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Topic whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Topic whereQuestionsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Topic whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Topic extends Model
{
    protected $fillable = ['name','questions_count','bio'];

    public function questions()
    {
    	return $this->belongsToMany(Question::class)->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'favorite_topics')->withTimestamps();
    }
}
