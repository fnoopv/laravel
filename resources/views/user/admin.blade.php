@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                <img width="1050" height="240" src="{{ asset('/images/profile/default.jpg') }}" alt="{{ $public->name }}的背景">
            </div>
        <div class="row">
                <div class="media" style="background-color: white;width: 1050px;">
                    <img class="mr-3 rounded-circle" width="168" src="{{ $public->avatar  }}" alt="{{ $public->name }}" style="margin-top: -75px;margin-left: 1rem">
                    <div class="media-body" style="margin-top: 20px;margin-bottom: 20px;">
                        <h2>{{ $public->name }}</h2>
                        <h5>暂无简介....</h5>
                    </div>
                    <div style="display: block;" class="pull-right">
                        <button class="btn btn-default pull-right" style="display: inline-block;margin-top: 3rem;margin-right: 1rem">编辑个人资料</button>
                    </div>
                </div>
            </div>
        <div class="row" style="margin-top: 1.5rem;">
            <div class="col-md-8" style="background-color: white;margin-right: 0.5rem">
                <ul class="nav nav-pills" style="margin-top: 1rem;padding-left: 1rem" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="question-tab" href="#question" data-toggle="tab" aria-selected="true">问题</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="answer-tab" href="#answer" data-toggle="tab" aria-selected="false">回答</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="following-tab" href="#following" data-toggle="tab" aria-selected="false">我关注的人</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="follower-tab" href="#follower" data-toggle="tab" aria-selected="false">关注我的人</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="favorite-tab" href="#favorite" data-toggle="tab" aria-selected="false">我的收藏</a>
                    </li>
                </ul>
                <hr>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="question" role="tabpanel" aria-labelledby="question-tab">
                        <span style="font-weight: 600">我的问题</span>
                        <hr>
                        @foreach($public->getQuestions($public->id) as $question)
                            <div class="card" style="margin-bottom: 1rem">
                                <div class="card-header">
                                    {{ $question->title }}
                                </div>
                                <div class="card-body">
                                    <p>{!! $question->body !!}</p>
                                </div>
                                <div class="actions">
                                    @if(Auth::check() && Auth::user()->owns($question))
                                        <button class="card-link btn"><a href="/questions/{{ $question->id }}/edit">编辑</a></button>
                                        <form action="/questions/{{ $question->id }}" method="post" class="delete-form card-text">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button class="btn card-link btn-danger">删除</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="answer" role="tabpanel" aria-labelledby="answer-tab">
                        <span style="font-weight: 600">我的回答</span>
                        <hr>
                        @foreach($public->getQuestion($public->id) as $questions)
                            @foreach($questions as $question)
                                <div class="card" style="margin-bottom: 1rem">
                                    <div class="card-header">
                                        <a href="questions/{{ $question->id }}">{{ $question->title }}</a>
                                    </div>
                                    <div class="card-body">
                                        <p>{!! $question->body !!}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="following" role="tabpanel" aria-labelledby="following-tab">
                        <span style="font-weight: 600">我关注的人</span>
                        <hr>
                    </div>
                    <div class="tab-pane fade" id="follower" role="tabpanel" aria-labelledby="follower-tab">
                        <span style="font-weight: 600">关注我的人</span>
                        <hr>
                    </div>
                    <div class="tab-pane fade" id="favorite" role="tabpanel" aria-labelledby="favorite-tab">
                        <span style="font-weight: 600">我的收藏</span>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row text-center" style="background-color: white;padding-top: 10px">
                    <div class="col-md-6" style="border-right: #3b97d7 solid 1px">
                        <span>关注了</span>
                        <p style="font-weight: bold;font-size: 20px;margin-top: 0.2rem">{{ $public->followings_count }}</p>
                    </div>
                    <div class="col-md-6">
                        <span>关注者</span>
                        <p style="font-weight: bold;font-size: 20px;margin-top: 0.2rem">{{ $public->followers_count }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
