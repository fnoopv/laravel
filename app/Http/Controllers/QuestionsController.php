<?php

namespace App\Http\Controllers;

use App\Topic;
use Auth;
use App\Question;
use App\Http\Requests\StoreQuestionRequest;

class QuestionsController extends Controller
{
    protected $questionRepository;

    public function _construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = $this->getQuestionsFeed();
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
        $topics = $this->nomallizeTopic($request->get('topics'));
        $data = [
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => Auth::id()
        ];

        $question = $this->createData($data);

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
        $question = $this->byIdWithTopics($id);
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
        $question = $this->byId($id);
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
        $question = $this->byId($id);
        $topics = $this->nomallizeTopic($request->get('topics'));

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
        $question = $this->byId($id);
        if (Auth::user()->owns($question))
        {
            $question->delete();
            return redirect('/');
        }
        abort('403','Forbidden');
    }

    public function nomallizeTopic(array $topics)
    {
        return collect($topics)->map(function ($topic){
           if (is_numeric($topic)) {
               Topic::find($topic)->increment('questions_count');
               return (int) $topic;
           }
           $newTopic = Topic::create(['name' => $topic,'questions_count'=>1]);

           return $newTopic->id;
        })->toArray();
    }

    public function byId($id)
    {
        return Question::find($id);
    }

    public function getQuestionsFeed()
    {
        return Question::latest('updated_at')->published()->with('user')->get();
    }

    public function createData(array $attibute)
    {
        return Question::create($attibute);
    }
    public function byIdWithTopics($id)
    {
        return Question::where('id',$id)->with('topics')->first();
    }
}
