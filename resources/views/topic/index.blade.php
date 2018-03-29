@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <h3 style="font-weight: bold">已关注的话题</h3>
            <hr>
        </div>
        @if(empty($topics))
            <h4>还没有关注话题，快去关注话题吧</h4>
        @else
            @foreach($topics as $topic)
                <a href="/topic/{{ $topic->id }}" style="font-weight: bold;margin-top: 1rem" class="btn btn-primary">{{ $topic->name }}</a>
            @endforeach
                <hr>
            @foreach($questions[0] as $question)
                    <div class="card">
                        <div class="card-header">
                            <a style="font-weight: bold;" href="/questions/{{ $question->id }}">{{ $question->title }}</a>
                            @foreach($question->topics as $top)
                                <a class="topic" href="/topic/{{ $top->id }}">{{ $top->name }}</a>
                            @endforeach
                        </div>
                        <div class="card-body">
                            <p class="card-text">{!! $question->body !!}</p>
                        </div>
                    </div>
            @endforeach
        @endif
    </div>
@endsection