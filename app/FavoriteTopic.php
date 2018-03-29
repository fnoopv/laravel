<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavoriteTopic extends Model
{
    protected $table = 'favorite_topics';
    protected $fillable=['user_id','topic_id'];
}
