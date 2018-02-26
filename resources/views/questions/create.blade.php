@extends('layouts.app')

@section('content')
@include('vendor.ueditor.assets')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Problem</div>

                <div class="card-body">
                    <form action="/questions" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}" placeholder="Title" id="title" required></input>
                            @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <script id="ueditor" name="body" type="text/plain"  class="form-control{{ $errors->has('body') ? '  is-invalid' : '' }}" style="width: 100%;height: 100%;" required>
                                {!! old('body') !!}
                            </script>
                            @if ($errors->has('body'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success pull-right" style="margin: 10px;">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var ue = UE.getEditor('ueditor');
    ue.ready(function() {
    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
    });
</script>
@endsection
