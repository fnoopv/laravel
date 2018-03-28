<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Http\Repositories\FavoriteRepository;
use App\Http\Repositories\QuestionRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    protected $favorite;

    /**
     * FavoriteController constructor.
     * @param FavoriteRepository $favoriteRepository
     */
    public function __construct(FavoriteRepository $favoriteRepository)
    {
        $this->favorite = $favoriteRepository;
    }

    /**
     * @param $question
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($question)
    {
        $user = Auth::guard('api')->id();
        $results = $this->favorite->favorited($user,$question);
        if ($results)
        {
            return response()->json(['favorited' => true]);
        }
        return response()->json(['favorited' => false]);
    }

    public function favorite()
    {
        $userToFavorite = $this->favorite->questionById(request('question'));
        $results = $this->favorite->favoriteThisQuestion(request('question'));
        if (count($results['attached']) > 0)
        {
            $userToFavorite->increment('favorites_count');
            return response()->json(['favorited' => true]);
        }
        $userToFavorite->decrement('favorites_count');
        return response()->json(['favorited' => false]);
    }
}
