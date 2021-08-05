<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src='http://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.js'></script>
    @if(Auth::user()->is_doctor == 1)

        @if(preg_match("/doctor/i",Route::currentRouteName()))
            <?php $bg = 'dark'; $txt = 'dark'; $title = 'Dashboard | Doctor'; $currroute = 'user.home.doctor'?>

            @elseif(preg_match("/patient/i",Route::currentRouteName()))
                <?php $bg = 'info'; $txt = 'dark'; $title = 'Dashboard | Patient'; $currroute = 'user.home.patient'?>
            @else
                <?php $bg = 'dark'; $txt = 'dark';$title = 'Dashboard';  $profileroute = 'user.profile.patient'; $currroute = 'user.home.patient'?>
        @endif

        @elseif(Auth::user()->is_doctor == 0)
            <?php $bg = 'primary'; $txt = 'dark'; $title = 'Dashboard | Patient'; $currroute = 'user.home.patient'?>
        @else
            <?php  ?>
    @endif
    <script type="text/javascript">
        $(document).ready(function(){
            $(".sideMenuToggler").on("click", function(){
               $(".wrapper").toggleClass("active");
            });
        });
    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-{{$bg}} bg-{{$txt}} fixed-top">
    <button class="navbar-toggler sideMenuToggler" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">
        @if(isset($title))
            {{$title}}
        @endif
    </a>
    <button class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>

    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>
                <div id="account-dropdownmenu" class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @if (isset($currroute))
                        @if(preg_match("/doctor/i",$currroute))
                            <a class="dropdown-item" href={{route('user.home.patient')}} >我的鬧鐘</a>
                            @elseif(preg_match("/patient/i",$currroute))
                                <a class="dropdown-item" href="{{route('user.home.doctor')}}" >回到 Doctor Page</a>
                        @endif
                    @endif
                    <a class="dropdown-item" href="/">關於</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('user.logout')}}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit()">登出</a>
                    <form action="{{ route('user.logout') }}" method="post" class="d-none" id="logout-form">@csrf</form>
                </div>
            </li>
        </ul>
    </div>
</nav>
        <!--側邊攔設計-->
        <div class="wrapper d-flex">
            <div class="sideMenu bg-mattBlackLight">
                <div class="sidebar">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a href={{route($currroute)}} class="nav-link">
                                <i class="fa fa-tachometer-alt icon" aria-hidden="true"></i>
                                <span class="text">Dashboard</span></a></li>

                        <li class="nav-item"><a href="#" class="nav-link"
                                onclick="event.preventDefault(); document.getElementById('profile-form').submit()">
                                <i class="fa fa-user-cog icon" aria-hidden="true"></i>
                                <span class="text">User Profile</span></a>
                                <form action="{{ route('user.showprofile') }}" method="post" class="d-none" id="profile-form">@csrf</form></li>

                        <li class="nav-item"><a href="{{ route('http404') }}" class="nav-link">
                                <i class="fa fa-database icon" aria-hidden="true"></i>
                                <span class="text">Chart</span></a></li>

                        <li class="nav-item"><a href="{{ route('http404') }}" class="nav-link">
                                <i class="fa fa-cogs icon" aria-hidden="true"></i>
                                <span class="text">Settings</span></a></li>

                        <li class="nav-item sideMenuToggler icon"><a href="#" class="nav-link">
                                <i class="fa fa-bars icon" aria-hidden="true"></i>
                                <span class="text">Resizes</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
{{--                        <div class="col-md-4 my-3">--}}
{{--                            --}}
{{--                        </div>--}}
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
<!-- {{--        <nav class="navbar navbar-expand-lg navbar-dark bg-{{$bg}}">--}}
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
{{--        </nav>--}} -->
</body>
</html>
