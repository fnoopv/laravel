@extends('layouts.app')

@section('style')
    <style type="text/css">
        .card-body img {
            width: 100%;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ $question->title }}
                    @foreach($question->topics as $topic)
                        <span class="badge">{{ $topic->name }}</span>
                    @endforeach
                </div>
                <div class="card-body">
                    {!! $question->body !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
