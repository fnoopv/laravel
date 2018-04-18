@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <img width="1050" height="240" src="{{ asset('/images/profile/default.jpg') }}" alt="{{ $user->name }}的背景">
        </div>
        <div class="row">
            <div class="media" style="background-color: white;width: 1050px;">
                <img class="mr-3 rounded-circle" width="168" src="{{ $user->avatar  }}" alt="{{ $user->name }}" style="margin-top: -75px;margin-left: 1rem">
                <div class="media-body" style="margin-top: 20px;margin-bottom: 20px;">
                    <h2>{{ $user->name }}</h2>
                    <h5>{{ $user->profiles->sign }}</h5>
                </div>
                <div style="display: block;" class="pull-right">
                    <a
                            class="btn btn-default pull-right"
                            style="display: inline-block;margin-top: 3rem;margin-right: 1rem;border: 1px solid green"
                            href="profile/edit/{{ Auth::id() }}"
                    >编辑个人资料</a>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 1.5rem;">
            <div class="col-md-8" style="background-color: white;margin-right: 0.5rem">
                <h3 style="padding-top: 1rem">编辑个人资料</h3>
                <hr>
                @include('flash::message')
                <form action="/profile/update/{{ $user->id }}" method="post">
                    {!! csrf_field() !!}
                    {{ method_field('Patch') }}
                    <div class="form-group">
                        <label for="email">邮箱</label>
                        <input class="form-control" type="email" value="{{ $user->email }}" id="email" name="email" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">用户名</label>
                        <input type="text" class="form-control" value="{{ $user->name }}" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="sex">性别</label>
                        <select class="form-control" id="sex" name="sex">
                            <option value="3">保密</option>
                            <option value="1">男</option>
                            <option value="2">女</option>
                        </select>
                    </div>
                    {{--<div class="form-group">--}}
                        {{--<label for="avatar">头像</label>--}}
                        {{--<input type="file" id="avatar" placeholder="{{ $user->avatar }}" class="form-control-file" name="avatar">--}}
                    {{--</div>--}}
                    <div class="form-group">
                        <label for="age">年龄</label>
                        <input type="number" value="{{ $user->profiles->age }}" class="form-control" id="age" name="age">
                    </div>
                    <div class="form-group">
                        <label for="birthday">生日</label>
                        <input type="date" id="birthday" value="{{ $user->profiles->birthday }}" class="form-control" name="birthday">
                    </div>
                    <div class="form-group">
                        <label for="url">个人网站</label>
                        <input type="text" id="url" class="form-control" value="{{ $user->profiles->url }}" name="url">
                    </div>
                    <div class="form-group">
                        <label for="phone">电话(11位)</label>
                        <input type="tel" id="phone" name="phone" class="form-control" value="{{ $user->profiles->phone }}" maxlength="11">
                    </div>
                    <div class="form-group">
                        <label for="sign">个人签名</label>
                        <input type="text" class="form-control" id="sign" name="sign" value="{{ $user->profiles->sign }}">
                    </div>
                    <div class="form-group"></div>
                    <input type="submit" value="提交" class="btn btn-default btn-primary pull-right" style="margin-bottom: 1rem">
                </form>
            </div>
            <div class="col-md-3">
                <div class="row text-center" style="background-color: white;padding-top: 10px">
                    <div class="col-md-6" style="border-right: #3b97d7 solid 1px">
                        <span>关注了</span>
                        <p style="font-weight: bold;font-size: 20px;margin-top: 0.2rem">{{ $user->followings_count }}</p>
                    </div>
                    <div class="col-md-6">
                        <span>关注者</span>
                        <p style="font-weight: bold;font-size: 20px;margin-top: 0.2rem">{{ $user->followers_count }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
