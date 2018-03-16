@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="card" style="width: auto;">
                    <div class="card-header">
                        <h2 style="font-weight: 600;">用户</h2>
                    </div>
                    <div class="media">
                        <img class="mr-3" width="72" style="margin: 5px;" src="{{ $user->avatar }}" alt="{{ $user->name }}">
                        <div class="media-body">
                            <h5 class="mt-3" style="font-weight: 600;">
                                {{ $user->name }}
                                <user-follow-button user="{{ $user->id }}" class="float-right" style="margin-right: 10px;"></user-follow-button>
                            </h5>
                            <p>个人简介</p>
                        </div>
                    </div>
                    <div class="user-statics row">
                        <div class="statics-item text-center col-md-4">
                            <div class="statics-text text-center">问题</div>
                            <div class="ststics-count">{{ $user->questions_count }}</div>
                        </div>
                        <div class="statics-item text-center col-md-4">
                            <div class="statics-text">回答</div>
                            <div class="ststics-count">{{ $user->answers_count }}</div>
                        </div>
                        <div class="statics-item text-center col-md-4">
                            <div class="statics-text">关注者</div>
                            <div class="ststics-count">{{ $user->followers_count }}</div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" style="font-size: 22px; font-weight: 600;">
                        提出的问题
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($user->getQuestions($user->id) as $question)
                            <li class="list-group-item">
                                <h4>
                                    <a href="/questions/{{ $question->id }}">
                                        {!! $question->title !!}
                                    </a>
                                </h4>
                                <span class="float-right">Time:{!! substr($question->created_at,0,10) !!}</span>
                                <h6>{!! $question->body !!}</h6>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
