@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                @foreach($questions as $question)
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="media">
                                <img class="mr-3 rounded-circle" width="48" src="{{ $question->user->avatar }}" alt="{{ $question->user->name }}">
                                <div class="media-body">
                                    <a href="/user/{{ $question->user->id }}"><h3 class="mt-0" style="font-weight: bold; color: black">{{ $question->user->name }}</h3></a>
                                    <span style="font-size: 12px;padding-top: 0;display: block;">发表于{{ substr($question->created_at,0,10) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="/questions/{{ $question->id }}" style="font-weight: bold;color: black">{{ $question->title }}</a>
                                <question-follow-button class="float-right" question="{{ $question->id }}"></question-follow-button>
                            </h5>
                            <p class="card-text">{!! html_entity_decode($question->body) !!}</p>
                            <div>
                                <span>{{ $question->getQuestionCount($question->id) }} 条评论</span>
                                <span style="margin-left: 20px">
                                    <favorite-question question="{{ $question->id }}"></favorite-question>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection