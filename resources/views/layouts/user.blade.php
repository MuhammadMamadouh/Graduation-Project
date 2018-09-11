<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') Al-Zhar Engineering </title>


    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset("css/user.css")}}"/>
    <link rel="stylesheet" href="{{asset("css/styles.css")}}"/>
</head>
<body>
<!--start nav-->
<div id="app">
    <nav class="navbar cssmenue navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/admin/dashboard') }}">
                    Handasa Azhar
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;<li class="nav-link"><a href="{{url('/profile')}}">Profile</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->en_name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!--end nav-->
    @yield('content')
</div>
<footer class="footer navbar navbar-default">
    <div class="container">

        <h4 class="text-capitalize text-right">Al-Azhar University</h4>
    </div>
</footer>

<!-- Scripts -->

<script src="{{ asset('js/jquery-1.11.3.min.js') }}"></script>

{{--<script src="{{ asset('js/jquery.mixitup.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/popper.js')}}"></script>--}}
{{--<script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>--}}
{{--<script src="{{ asset('js/popper.min.js') }}"></script>--}}
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/user.js') }}"></script>
@yield('script')
</body>
</html>
