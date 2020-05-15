@extends('layouts.app')
@section('content')
<div class="container" id="searchResult">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    搜索到 {{ $questions->count() }} 个问题
                </div>
                <div class="card-body">
                    <ul>
                        @if(empty($questions))
                            <li>没有相关问题</li>
                        @else
                            @foreach($questions as $question)
                                <li>
                                    <a href="/questions/{{ $question->id }}" style="font-weight: bold" class="mt-0">{{ $question->title }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    搜索到 {{ $users->count() }} 个用户
                </div>
                <div class="card-body">
                    <ul>
                        @if(empty($users))
                            <li>没有相关用户</li>
                        @else
                            @foreach($users as $user)
                                <li>
                                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}的头像" width="48">
                                    <a href="/user/{{ $user->id }}" class="mt-0" style="font-weight: bold; font-size: 18px">{{ $user->name }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    搜索到 {{ $topics->count() }} 个话题
                </div>
                <div class="card-body">
                    <ul>
                        @if(empty($topics))
                            <li>没有相关话题</li>
                        @else
                            @foreach($topics as $topic)
                                <li>
                                    <a href="/topic/{{ $topic->id }}" style="font-weight: bold;margin-top: 1rem">{{ $topic->name }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection