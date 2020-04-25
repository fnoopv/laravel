@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 5rem">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div style="background-color: white;padding: 1rem">
                    <h3 style="font-weight: bold">{{ $topics->name }}</h3>
                    <p>{!! $topics->bio !!}</p>
                    <hr>
                    @foreach($questions as $question)
                        @if($question != null)
                            <div class="card" style="margin-bottom: 1rem">
                                <h5 class="card-header">
                                    <a href="/questions/{{ $question->id }}" style="font-weight: bold">{{ $question->title }}</a>
                                </h5>
                                <div class="card-body">
                                    <p class="card-text">{!! $question->body !!}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection