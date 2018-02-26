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
                            <input type="text" name="title" class="form-control" placeholder="Title" id="title"></input>
                        </div>
                        <script id="ueditor" name="body" type="text/plain"></script>
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
