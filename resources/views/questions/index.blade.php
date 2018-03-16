@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
            @foreach($questions as $question)
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="media">
                            <img class="mr-3 rounded-circle" width="32" src="{{ $question->user->avatar }}" alt="{{ $question->user->name }}">
                            <div class="media-body">
                                <a href="/user/{{ $question->user->id }}"><h3 class="mt-0">{{ $question->user->name }}</h3></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="/questions/{{ $question->id }}"><b>{{ $question->title }}</b></a>
                        </h5>
                        <p class="card-text">{!! $question->body !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>
@endsection