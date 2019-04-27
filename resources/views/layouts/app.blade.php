<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <meta name="_token" content="{{ csrf_token() }}"> 

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

       <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('style')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('Publons', 'Publons') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                         <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Browse</a>
                            <div class="dropdown-menu">
                             <a class="dropdown-item" href="{{url('reviewers')}}">Reviewers</a>
                             <a class="dropdown-item" href="{{url('journals')}}">Journals</a>
                             <a class="dropdown-item" href="{{url('publications')}}">Publications</a>
                             <a class="dropdown-item" href="{{url('institutions')}}">Institutions</a>
                             <a class="dropdown-item" href="{{url('countries')}}">Countries/Regions</a>
                             
                            </div>
                          </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="{{url('home')}}">{{ __('Dashboard') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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

        <main class="">
            @yield('content')
        </main>

     <footer class="container-fluid" style="background-color: black;color: white">
      <div class="row" style="padding: 50px 10px 20px 10px;">
          <div class="col-md-3" style="text-align: center;">
            <p>Publons is a part of</p>
            <img src="{{url('image/logo/logo.png')}}" width="50%">
           <!--  <hr style="border-top:1px solid #FFFFFF;transform: rotate(90deg);margin-left: 180px;margin-top: -70px"> -->
          </div>
          <div class="col-md-3">
              <h3>Contact</h3><hr style="border-top:1px solid #FFFFFF;">
              <p><a href="#">Send Reviews</a></p>
              <p><a href="#">Send Reviews</a></p>
              <p><a href="#">Send Reviews</a></p>
          </div>
           <div class="col-md-3">
              <h3>Contact</h3><hr style="border-top:1px solid #FFFFFF">
              <p><a href="#">Send Reviews</a></p>
              <p><a href="#">Send Reviews</a></p>
              <p><a href="#">Send Reviews</a></p>
          </div>
           <div class="col-md-3">
              <h3>Contact</h3><hr style="border-top:1px solid #FFFFFF">
              <p><a href="#">Send Reviews</a></p>
              <p><a href="#">Send Reviews</a></p>
              <p><a href="#">Send Reviews</a></p>
          </div>
      </div>  
      </footer>


    </div>
</body>
</html>
 @stack('scripts')

