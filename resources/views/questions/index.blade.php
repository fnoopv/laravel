@extends('layouts.app')

@section('content')
    <div class="container" id="top">
        <div class="row">
            <div class="col-md-8">
                @foreach($questions as $question)
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="media">
                                <img class="mr-3 rounded-circle" width="32" src="{{ $question->user->avatar }}" alt="{{ $question->user->name }}">
                                <div class="media-body">
                                    <a href="/user/{{ $question->user->id }}"><h3 class="mt-0" style="font-weight: bold; color: black">{{ $question->user->name }}</h3></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="/questions/{{ $question->id }}" style="font-weight: bold;color: black">{{ $question->title }}</a>
                            </h5>
                            <p class="card-text">{!! $question->body !!}</p>
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
    @section('js')
        <script>
            $(function () {
                var jsonData = $.ajax({
                    'url': 'api'
                })
            })
        </script>
    @endsection
@endsection