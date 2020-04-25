<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\FavoriteTopic
 *
 * @property int $id
 * @property int $user_id
 * @property int $topic_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FavoriteTopic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FavoriteTopic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FavoriteTopic query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FavoriteTopic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FavoriteTopic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FavoriteTopic whereTopicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FavoriteTopic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FavoriteTopic whereUserId($value)
 * @mixin \Eloquent
 */
class FavoriteTopic extends Model
{
    protected $table = 'favorite_topics';
    protected $fillable=['user_id','topic_id'];
}
