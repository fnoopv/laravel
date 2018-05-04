@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>
                            <h4>已经注册成功了，<a href="https://mail.qq.com">点击验证邮箱</a></h4>
                            <h4>或者<a href="{{ url('/')  }}">继续浏览网站</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection