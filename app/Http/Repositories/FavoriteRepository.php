<?php

namespace App\Http\Repositories;
use App\Favorite;
use App\Question;
use Illuminate\Support\Facades\Auth;

/**
 * Created by PhpStorm.
 * User: sunhao
 * Date: 2018/3/26
 * Time: 11:08
 */

class FavoriteRepository
{
    public function createData(array $attribute)
    {
        return Favorite::create($attribute);
    }

    public function questionById($id)
    {
        return Question::find($id);
    }

    public function favorited($user,$question)
    {
        return !! Favorite::where([
            'user_id' => $user,
            'question_id' => $question
        ])->first();
    }

    public function favoriteThisQuestion($question)
    {
        return Auth::guard('api')->user()->favorites()->toggle($question);
    }
}