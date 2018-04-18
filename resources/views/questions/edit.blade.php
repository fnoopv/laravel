@extends('layouts.app')

@section('content')
    @include('vendor.ueditor.assets')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Problem</div>

                    <div class="card-body">
                        <form action="/questions/{{ $question->id }}" method="post">
                            {{ method_field('PATCH') }}
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="title">标题</label>
                                <input type="text" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ $question->title }}" placeholder="Title" id="title" required></input>
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <select name="topics[]" class="form-control js-example-placeholder-multiple js-data-example-ajax" multiple="multiple">
                                    @foreach($question->topics as $topic)
                                        <option value="{{ $topic->id }}" selected="selected">{{ $topic->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <script id="ueditor" name="body" type="text/plain"  class="form-control{{ $errors->has('body') ? '  is-invalid' : '' }}" style="width: 100%;height: 100%;" required>
                                    {!! $question->body !!}
                                </script>
                                @if ($errors->has('body'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-success" style="margin: 10px;float:right">提交</button>
                                    </form>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                        @section('js')
                                    <script type="text/javascript">
                                var ue = UE.getEditor('ueditor');
                                ue.ready(function() {
                                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                                });

                                $(document).ready(function() {
                                    function formatTopic (topic) {

                                        return "<div class='select2-result-repository clearfix'>" +

                                        "<div class='select2-result-repository__meta'>" +

                                        "<div class='select2-result-repository__title'>" +

                                        topic.name ? topic.name : "Laravel"   +

                                            "</div></div></div>";

                                    }


                                    function formatTopicSelection (topic) {

                                        return topic.name || topic.text;

                                    }


                                    $(".js-example-placeholder-multiple").select2({

                                        tags: true,

                                        placeholder: '选择相关话题',

                                        minimumInputLength: 2,

                                        ajax: {

                                            url: '/api/topics',

                                            dataType: 'json',

                                            delay: 250,

                                            data: function (params) {

                                                return {

                                                    q: params.term

                                                };

                                            },

                                            processResults: function (data, params) {

                                                return {

                                                    results: data

                                                };

                                            },

                                            cache: true

                                        },

                                        templateResult: formatTopic,

                                        templateSelection: formatTopicSelection,

                                        escapeMarkup: function (markup) { return markup; }

                                    });
                                });
                                </script>
@endsection
@endsection