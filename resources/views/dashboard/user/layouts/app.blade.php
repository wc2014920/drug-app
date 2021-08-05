<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doctor Dashboard | Home</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .dropdown-menu li:hover .sub-menu {visibility: visible;}
        .dropdown:hover .dropdown-menu {display: block;}
        body{
            color: #1b1e21;
        }
    </style>
</head>
    <body>
{{--        <div class="pos-f-t">--}}
            @if(Auth::user()->is_doctor == 1)

                @if(Route::currentRouteName() == 'user.home.doctor')
                    <?php $bg = 'dark'; $txt = 'light';?>
                @endif

                @if(Route::currentRouteName() == 'user.home.patient')
                    <?php $bg = 'info'; $txt = 'dark';?>
                @endif

                @elseif(Auth::user()->is_doctor == 0)
                    <?php $bg = 'primary'; $txt = 'dark';?>
            @endif
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="#">Navbar</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Dropdown
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                            </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
                </nav>
{{--        <nav class="navbar navbar-expand-lg navbar-dark bg-{{$bg}}">--}}
{{--            <div class="container-fluid">--}}
{{--                <a class="navbar-brand" href="#">{{ Illuminate\Support\Facades\Auth::guard('web')->user()->name }}</a>--}}
{{--                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"  aria-expanded="false" aria-label="Toggle navigation">--}}
{{--                    <span class="navbar-toggler-icon"></span>--}}
{{--                </button>--}}
{{--                <div class="collapse navbar-collapse" id="main_nav">--}}
{{--                    <ul class="navbar-nav">--}}
{{--                        <li class="nav-item"><a class="nav-link" href="#"> 關於此網站 </a></li>--}}
{{--                        <li class="nav-item dropdown">--}}
{{--                            <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"> 個人 </a>--}}
{{--                            <ul class="dropdown-menu">--}}
{{--                                <li><a class="dropdown-item" href="#"> 個人資料 </a></li>--}}
{{--                                <li><a class="dropdown-item" href="#"> 個人藥物鬧鐘 </a></li>--}}
{{--                                <li><a class="dropdown-item" href="#"> 登出 </a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item dropdown">--}}
{{--                            <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">  主要功能  </a>--}}
{{--                            <ul class="dropdown-menu">--}}
{{--                                <li><a class="dropdown-item" href="#"> 新增 / 建立 </a></li>--}}
{{--                                <li><a class="dropdown-item" href="#"> 搜尋 / 查看 / 編輯 </a></li>--}}
{{--                                <li><a class="dropdown-item" href="#"> 說明 </a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </nav>--}}

    </body>
</html>
