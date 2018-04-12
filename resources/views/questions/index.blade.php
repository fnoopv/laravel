@extends('layouts.app')
@section('content')
    <div class="container" id="top">
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
            <div class="col-md-4">
                <div class="card" style="width: 18rem; position: fixed;">
                    <img class="card-img-top" src="{{ asset('images/header/index.png') }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title" style="font-weight: bold">坚强</h5>
                        <p class="card-text">强大的内心就是你最厉害的武器，只有内心强大的人，才是一个强者</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">保持内心!</li>
                        <li class="list-group-item">大胆去做!</li>
                        <li class="list-group-item">不要停下脚步!</li>
                    </ul>
                    <div class="card-body">
                        <a href="#top" class="back-to-top"> Back to top </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection