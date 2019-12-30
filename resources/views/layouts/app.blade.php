<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SukurinėsVonios') }}</title>

    <!--  <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css"> -->
     <!-- Styles -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style type="text/css">
#toolbar {
  font-family: 'Open Sans', sans-serif;
  color: #484848;
  font-size: 17px;
}

#toolbar .icon {
  height: 50px;
  width: 50px;
  margin-bottom: 5px;

}

#toolbar h1 {
  color: #4fc08d;
  font-size: 21px;
}
#toolbar .logoText{
    font-family: 'Roboto','Open Sans', sans-serif;
    color: #4fc08d !important;  
    font-size: 23px;
    font-weight: bold;
    text-decoration: none;
}
#toolbar img:hover{ 
  animation: shake 275ms infinite;
  animation-timing-function: linear;   
}

@keyframes shake {
  0% { transform: rotate(0.8deg); }
  50% { transform: rotate(-0.8deg); }
  100% { transform: rotate(1.8deg); }
}

    </style>
</head>
<body>
    
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div id="toolbar" class="container">
                <div  class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    
                    <!-- Branding Image -->
                    <a href="{{ url('/') }}">
                        <img id="toolbar" class="icon" src="{{ asset('images/logo.png') }}">
                       <!--  {{ config('app.name', 'SukurinėsVonios') }} -->
                    </a>
                     <a class="logoText shake" href="{{ url('/') }}">
                       SukurinėsVonios
                    </a>


                        

                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li><a href="{{ route('admin.apartments.index') }}">Apartments</a></li>

                            <li><a href="{{ route('admin.users.index') }}">Users</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>
    @include('layouts.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
