@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row  justify-content-center">
            <div class="col-md-6" style="background-color: white">
                <form action="/topic/{{ $top->id }}/update" style="margin-top: 1rem" method="post">
                    {{ method_field('PATCH') }}
                    {!! csrf_field() !!}
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">话题名称</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="name" name="name" value="{{ $top->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bio" class="col-sm-2 col-form-label">简介</label>
                        <div class="col-sm-10">
                            <textarea id="bio" style="width: 400px;height: 300px" name="bio">{{ $top->bio }}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-default pull-right" style="margin-bottom: 1rem;margin-right: 2rem;">提交</button>
                </form>
            </div>
        </div>
    </div>
@endsection