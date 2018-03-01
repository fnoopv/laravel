<?php

namespace App\Http\Controllers;

use App\Http\Repositories\AnswerRepository;
use App\Http\Requests\StoreAnswerRequest;
use Auth;

class AnswersController extends Controller
{
    protected $answer;

    /**
     * AnswersController constructor.
     * @param AnswerRepository $answerRepository
     */
    public function __construct(AnswerRepository $answerRepository)
    {
        $this->answer = $answerRepository;
    }

    public function store(StoreAnswerRequest $request,$question)
    {
        $answer = $this->answer->createData([
            'question_id' => $question,
            'user_id' => Auth::id(),
            'body' => $request->get('body')
        ]);

        $answer->question()->increment('answers_count');
        return back();
    }
}
