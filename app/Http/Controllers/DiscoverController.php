<?php

namespace App\Http\Controllers;

use App\FavoriteTopic;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscoverController extends Controller
{
    public function index()
    {
        $questions = array();
        if (Auth::check())
        {
            $user = Auth::id();
            $topics = FavoriteTopic::all()->where('user_id','=',$user)->pluck('topic_id');
            foreach ($topics as $topic)
            {
                array_push($questions,Question::all()->find($topic));
            }

            return view('questions.discover',compact('questions'));
        }else{
            $questions =  Question::published()->get();
            return view('questions.discover',compact('questions'));
        }
    }
}
