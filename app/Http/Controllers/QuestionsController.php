<?php

namespace App\Http\Controllers;

use App\Http\Repositories\QuestionRepository;
use App\Topic;
use Auth;
use App\Question;
use App\Http\Requests\StoreQuestionRequest;

class QuestionsController extends Controller
{
    protected $question;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->question = $questionRepository;
        $this->middleware('auth')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = $this->question->getQuestionsFeed();
        return view('questions.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request)
    {
        $topics = $this->question->nomallizeTopic($request->get('topics'));
        $data = [
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => Auth::id()
        ];

        $question = $this->question->createData($data);

        $question->topics()->attach($topics);

        return redirect()->route('questions.show',[$question->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = $this->question->byIdWithTopicsAndAnswers($id);
        return view('questions.show',compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->question->byId($id);
        if (Auth::user()->owns($question))
        {
            return view('questions.edit',compact('question'));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreQuestionRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreQuestionRequest $request, $id)
    {
        $question = $this->question->byId($id);
        $topics = $this->question->getQuestionsFeed($request->get('topics'));

        $question->update([
            'title' => $request->get('title'),
            'body' => $request->get('body'),

        ]);
        $question->topics()->sync($topics);

        return redirect()->route('questions.show',[$question->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = $this->question->byId($id);
        if (Auth::user()->owns($question))
        {
            $question->delete();
            return redirect('/');
        }
        abort('403','Forbidden');
    }
}
