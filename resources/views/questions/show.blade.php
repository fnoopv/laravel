@extends('layouts.app')

@section('content')
<div class="container" id="top" style="margin-top: 5rem">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    {{ $question->title }}
                    @foreach($question->topics as $topic)
                        <a class="topic" href="/topic/{{ $topic->id }}">{{ $topic->name }}</a>
                    @endforeach
                </div>
                <div class="card-body">
                    {!! $question->body !!}
                </div>
                <div class="actions">
                    @if(Auth::check() && Auth::user()->owns($question))
                        <span class="card-link"><a href="/questions/{{ $question->id }}/edit">编辑</a></span>
                        <form action="/questions/{{ $question->id }}" method="post" class="delete-form card-text">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button class="button is-naked delete-button card-link">删除</button>
                        </form>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    {{ $question->answers_count }} answers
                </div>
                <div class="card-body content">
                    @foreach($question->answers as $answer)
                        <div class="media">
                            <a href="#" class="media-left" style="width: 10%">
                                <img width="32" src="{{ $answer->user->avatar }}" alt="{{ $answer->user->name }}">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="/user/{{ $answer->user->id }}">
                                        {{ $answer->user->name }}
                                    </a>
                                </h4>
                                {!! $answer->body !!}
                            </div>
                            <user-vote-button answer="{{ $answer->id }}" count="{{ $answer->votes_count }}"></user-vote-button>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @if(Auth::check())
                        <form action="/questions/{{ $question->id }}/answer" method="post">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="ueditor">添加答案</label>
                                <script id="ueditor" name="body" type="text/plain"  class="{{ $errors->has('body') ? '  is-invalid' : '' }}" style="width: 100%;" required>
                                    {!! old('body') !!}
                                </script>
                                @if ($errors->has('body'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-success" style="margin: 10px; float:right">提交</button>
                        </form>
                    @else
                        <a href="{{ url('login') }}" class="btn btn-success btn-block">登陆发表</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header question_follow">
                    <h2>{{ $question->followers_count }}</h2>
                    <span>关注者</span>
                </div>
                <div class="card-body row">
                    <div class="col-md-6">
                        <question-follow-button question="{{ $question->id }}"></question-follow-button>
                    </div>
                    <div class="col-md-6">
                        <a href="#ueditor" class="btn btn-primary">提交答案</a>
                    </div>
                </div>
            </div>
            <div class="card">
                  <a><img class="card-img-top" src="{{ $question->user->avatar }}" alt="{{ $question->user->name }}"></a>
                  <div class="card-body">
                       <h4 class="card-title" style="text-align: center"><b>{{ $question->user->name }}</b></h4>
                       <div class="user-statics">
                             <div class="statics-item text-center">
                                  <div class="statics-text">问题</div>
                                      <div class="ststics-count">{{ $question->user->questions_count }}</div>
                                  </div>
                                  <div class="statics-item text-center">
                                        <div class="statics-text">回答</div>
                                        <div class="ststics-count">{{ $question->user->answers_count }}</div>
                                  </div>
                                  <div class="statics-item text-center">
                                        <div class="statics-text">关注者</div>
                                        <div class="ststics-count">{{ $question->user->followers_count }}</div>
                                  </div>
                             </div>
                             <div class="row">
                                   <div class="col-md-6">
                                        <user-follow-button user="{{ $question->user_id }}"></user-follow-button>
                                   </div>
                                   <div class="col-md-6">
                                        <send-message user="{{ $question->user_id }}"></send-message>
                                   </div>
                             </div>
                       </div>
                  </div>
            </div>
        </div>
    </div>
</div>
@section('js')
    <script type="text/javascript">
        var ue = UE.getEditor('ueditor');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
        });
    </script>
@endsection
@endsection
