<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api_token" content="{{ Auth::check() ? 'Bearer '.Auth::user()->api_token : 'Bearer ' }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('style')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel fixed-top" role="navigation">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="font-size: 20px;font-weight: 600;color: #2ea8e5;">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <div>
                    <ul class="nav nav-pills">
                        <li style="margin: 0 15px; font-weight: 400; font-size: 16px" class="nav-item">
                            <a style="color: #3b4249" href="/">首页</a>
                        </li>
                        <li style="margin: 0 15px; font-weight: 400; font-size: 16px" class="nav-item">
                            <a style="color: #3b4249" href="/discover">发现</a>
                        </li>
                        <li style="margin: 0 15px; font-weight: 400; font-size: 16px" class="nav-item">
                            <a style="color: #3b4249" href="/topics">话题</a>
                        </li>
                    </ul>
                </div>
                <form class="form-inline my-2 my-lg-0" style="margin-left: 20px" action="/search" method="post">
                    {{ csrf_field() }}
                    <input class="form-control mr-sm-3" type="search" placeholder="搜索用户 话题 文章" aria-label="Search" id="key" name="key">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">搜索</button>
                </form>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <a href="/questions/create" class="btn btn-default btn-primary" style="font-weight: 400; font-size: 16px; margin-right: 12px">提问</a>
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}" style="font-size: 16px">登陆</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}" style="font-size: 16px">注册</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     <span style="font-size: 16px;font-weight: 400;">{{ Auth::user()->name }}</span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a href="/profile/{{ Auth::user()->id }}" class="dropdown-item" style="font-size: 16px">
                                        个人中心
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="font-size: 16px">
                                        注销
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container" style="text-align: center;">
            @include('flash::message')
        </div>
        <div style="padding-top: 5rem">
            @yield('content')
        </div>

        <footer class="footer navbar-fixed-bottom" style="margin: 2rem 0 2rem 0">
            <div class="container-fluid">
                <div style="text-align: center">
                    <ul style="list-style: none">
                        <li>Copyright@2020 fnoopv</li>
                        <li>联系站长：<a href="mailto:fnoopv@outlook.com?subject=网站建议">Email</a></li>
                    </ul>
                </div>
            </div>
        </footer>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @include('vendor.ueditor.assets')
    @yield('js')
    <script>
        $('#flash-overlay-modal').modal();
    </script>
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
</body>
</html>
