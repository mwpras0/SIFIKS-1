<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIFIKS  |
        @if(session('role') == "Doctor")
            {{ __('Doctors') }}
        @elseif(session('role') == "Admin")
            {{ __('Administrator') }}
        @endif
    </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="{{ asset("favicon.ico") }}">
    <link rel="stylesheet" href="{{ asset("bower_components/bootstrap/dist/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("bower_components/font-awesome/css/all.css") }}">
    <link rel="stylesheet" href="{{ asset("bower_components/Ionicons/css/ionicons.min.css") }}">
    <link rel="stylesheet" href="{{ asset("bower_components/admin-lte/dist/css/AdminLTE.min.css") }}">
    <link rel="stylesheet" href="{{ asset("bower_components/admin-lte/dist/css/skins/_all-skins.min.css") }}">
    <link rel="stylesheet" href="{{ asset("bower_components/morris.js/morris.css") }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Orbitron">

    <style>
        .sidebar-form {
            margin-top: 0 !important;
        }
        .clock-box {
            /*font-family: 'Orbitron', sans-serif !important;*/
            background: #374850;
            padding:5px 10px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            color: #ddd;
            text-align: center;
            font-weight: bold;
            cursor: default;
        }
        .loading-box {
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            position: fixed;
            display: block;
            filter: opacity(0.7);
            background-color: #fff;
            z-index: 9999;
            text-align: center;
        }
        .loading-img {
            position: absolute;
            width: 7.5%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            z-index: 10000;
        }
    </style>
</head>
<body class="
    @if(session('role') == "Doctor")
        skin-yellow
    @elseif(session('role') == "Pharmacist")
        skin-blue
    @else
        skin-red
    @endif
    hold-transition sidebar-mini
">
<!-- Site wrapper -->

<div class="wrapper">
    <div class="loading-box" id="loading">
        <img src="{{ asset('images/loading-adm.gif') }}" class="loading-img" alt="Loading...">
    </div>

    <div id="bodyContent" >
        <header class="main-header">
            <!-- Logo -->
            <a href="
            @if(session('role') == "Doctor")
                {{ route('doctor.dashboard') }}
            @else
                {{ route('admin.dashboard') }}
            @endif
                " class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">
                <img src="{{ asset('/images/LOGO-S.png') }}" alt="LOGO" width="50%" border="0">
            </span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">
                @if(session('role') == "Doctor")
                    <img src="{{ asset('/images/sifiks2.png') }}" alt="sifiks2" width="40%" border="0">
                @else
                    <img src="{{ asset('/images/sifiks5.png') }}" alt="sifiks5" width="40%" border="0">
                @endif
            </span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ asset('/user_images/'.Auth::guard(session('guard'))->user()->profile_picture) }}" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{ Auth::guard(session('guard'))->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="{{ asset('/user_images/'.Auth::guard(session('guard'))->user()->profile_picture) }}" class="img-circle" alt="User Image">

                                    <p>
                                        {{ Auth::guard(session('guard'))->user()->name }}
                                        <small>
                                            {{ Auth::guard(session('guard'))->user()->email }}
                                        </small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a class="btn btn-default btn-flat"
                                        @if(Auth::guard('admin')->check())
                                            href="{{ route('admin.profile', Auth::guard('admin')->user()->id ) }}"
                                        @elseif(Auth::guard('doctor')->check())
                                            href="{{ route('doctor.profile', Auth::guard('doctor')->user()->id ) }}"
                                        @endif
                                        >
                                            <i class="fa far fa-user"></i>
                                            &nbsp;Profil
                                        </a>
                                    </div>
                                    <div class="pull-right">
                                        <a  class="btn btn-danger" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{{ asset('user_images/'.Auth::guard(session('guard'))->user()->profile_picture) }}" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>{{ Auth::guard(session('guard'))->user()->name }}</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> {{ session('role') }}</a>
                    </div>
                </div>
                <!-- search form -->
                <div class="sidebar-form">
                    <div class="clock-box">
                        <i class="fas fa-clock"></i>&nbsp;
                        <span class="clock"></span>
                    </div>
                </div>
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header text-center">WORKING SPACE</li>
                    <li>
                        @if(session('role') == "Admin" && Auth::guard('admin')->check())
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="fa fas fa-tachometer-alt"></i>
                                <span>Dashboard</span>
                            </a>
                        @elseif(session('role') == "Doctor" && Auth::guard('doctor')->check())
                            <a href="{{ route('doctor.dashboard') }}">
                                <i class="fa fas fa-tachometer-alt"></i>
                                <span>Dashboard</span>
                            </a>
                        @endif
                    </li>
                    <li>
                        @if(session('role') == "Admin" && Auth::guard('admin')->check())
                            <a href="{{ '/admin/article' }}">
                                <i class="fa far fa-newspaper"></i>
                                <span>Artikel</span>
                            </a>
                        @elseif(session('role') == "Doctor" && Auth::guard('doctor')->check())
                            <a href="{{ '/doctor/article' }}">
                                <i class="fa far fa-newspaper"></i>
                                <span>Artikel</span>
                            </a>
                        @endif
                    </li>
                    <li>
                        @if(session('role') == "Admin" && Auth::guard('admin')->check())
                            <a href="{{ route('admin.thread.index', ['query' => "all"]) }}">
                                <i class="fa far fa-comments"></i>
                                <span>Diskusi</span>
                            </a>
                        @elseif(session('role') == "Doctor" && Auth::guard('doctor')->check())
                            <a href="{{ route('doctor.thread.index', ['query' => "all"]) }}">
                                <i class="fa far fa-comments"></i>
                                <span>Diskusi</span>
                            </a>
                        @endif
                    </li>
                    @if(session('role') == "Admin")
                        <li>
                            <a href="{{ route('admin.index') }}">
                                <i class="fa fa-user-secret"></i>
                                <span>Admin</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('doctor.index') }}">
                                <i class="fa fa-user-md"></i>
                                <span>Dokter</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('hospital.index') }}">
                                <i class="fa fa-diagnoses"></i>
                                <span>Apoteker</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('member.index') }}">
                                <i class="fa fa-users"></i>
                                <span>Member</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            @yield('content')

        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <p class="text-center">Copyright © 2019 <a href="https://flying-coders.github.io/" target="_blank">Flying Coders</a>
                <button type="button" onclick="window.scrollTo({ top: 0, behavior: 'smooth' });" class="pull-right btn btn-primary"><i class="fas fa-chevron-up"></i></button>
            </p>
        </footer>
    </div>
</div>
<!-- ./wrapper -->

<script src="{{ asset("bower_components/jquery/dist/jquery.min.js") }}"></script>
<script src="{{ asset("bower_components/bootstrap/dist/js/bootstrap.min.js") }}"></script>
<script src="{{ asset("bower_components/jquery-slimscroll/jquery.slimscroll.min.js") }}"></script>
<script src="{{ asset("bower_components/fastclick/lib/fastclick.js") }}"></script>
<script src="{{ asset("bower_components/admin-lte/dist/js/adminlte.min.js") }}"></script>
<script src="{{ asset("bower_components/admin-lte/dist/js/demo.js") }}"></script>
<script src="{{ asset("bower_components/ckeditor/ckeditor.js") }}"></script>
<script>
    $(document).ready( function() {
        $('form').attr('autocomplete', 'off');
        clockUpdate();
        setInterval(clockUpdate, 1000);
    });

    $(window).on('load', function() {
        $('#loading').hide();
    })

    CKEDITOR.replaceClass = 'ckdefault';

    CKEDITOR.replace( 'ckmini1', {
        customConfig: 'custom/ckmini-config.js'
    });

    CKEDITOR.replace( 'ckmini2', {
        customConfig: 'custom/ckmini-config.js'
    });

    function clockUpdate() {
        var date = new Date();
        function addZero(x) {
            if (x < 10) {
                return x = '0' + x;
            } else {
                return x;
            }
        }

        function twelveHour(x) {
            if (x > 12) {
                return x = x - 12;
            } else if (x == 0) {
                return x = 12;
            } else {
                return x;
            }
        }

        var h = addZero(twelveHour(date.getHours()));
        var m = addZero(date.getMinutes());
        // var s = addZero(date.getSeconds());

        $('.clock').text(h + ':' + m + ' WIB'); // + ':' + s
    }
</script>
</body>
</html>
