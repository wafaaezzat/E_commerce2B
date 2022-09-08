<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title')
    </title>

    <!-- Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&family=Roboto&display=swap" rel="stylesheet">

    <!--     Font Awesome and icons     -->
    <link href="{{URL::asset('admin/assets/css/normalize.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('admin/assets/css/all.min.css')}}" rel="stylesheet"/>

    <!-- Styles -->
    <link href="{{URL::asset('frontend/css/bootstrap5.css') }}" rel="stylesheet">

    <!--- Style css -->
    @if (App::getLocale() == 'ar')  {{-- خش جوا App/config/app.php  'locale' => 'en', --}}
    <link href="{{ URL::asset('admin/assets/css/rtl.css') }}" rel="stylesheet">
    @else
        <link href="{{ URL::asset('admin/assets/css/ltr.css') }}" rel="stylesheet">
    @endif

    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">


{{--  owlcarousel  --}}
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">

{{-- Search product in laravel | Ajax auto complete  --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">


    <style>
        a{
            text-decoration: none;
        }
        p{
            color: #2d3748;
        }

        /*=============================*/
        .divmarquee {
            background-color: rgb(40, 113, 126);
            padding: 10px;
            color: #fff;
            text-align: right !important;
            overflow: hidden;
        }

        .marquee .news {
            margin: 0 10px;
            font-size: 16px;
        }

        .marquee .news .NewsLink {
            text-decoration: none;
            color: #8db3db !important;
            font-weight: bold;
            margin: 0 10px;
            cursor: pointer;
        }
        .marquee .news svg{
            width: 25px !important;
        }
        .marquee:hover {
            animation-play-state: paused;
        }

        .marquee {
            position: relative;
            animation-name: newsChange;
            animation-duration: 30s;
            animation-iteration-count: infinite;
            animation-direction: normal;
            animation-timing-function: linear;
        }
        @keyframes newsChange {
            @if (App::getLocale() == 'ar')
             0% {
                left: -100%;
                top: 0;
            }
            100% {
                left: 25%;
                top: 0;
            }
        @else
          0% {
            left: 25%;
            top: 0;
             }
          100% {
                left: -100%;
                top: 0;
              }
        @endif
        }
    </style>

{{--    @toastr_css--}}
</head>
<body>
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="https://smhttp-ssl-73217.nexcesscdn.net/pub/media/logo/stores/2/logo.png" alt="Welcome to 2B" style="width: 60px; height: 60px">
                </a>

                @if(Auth::check())
{{-- Search product in laravel | Ajax auto complete  --}}
                <div class="search-bar" style="width: 30% ; margin-left: 3%">
                    <form action="{{url('searchProduct')}}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="search" id="search_product" name="product_name" class="form-control" placeholder="{{trans('main_trans.Search_Products')}}" required>
                            <button type="submit" class="input-group-text"> <i class="fa fa-search"></i> </button>
                        </div>
                    </form>
                </div>
                @endif

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
{{--                    <!-- Left Side Of Navbar -->--}}
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav me-auto">
                                {{-- mcamera to support multi language تعدد اللغات --}}
                                <div class="btn-group mb-1 ml-3">
                                    <button type="button" class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        @if (App::getLocale() == 'ar')
                                            {{ LaravelLocalization::getCurrentLocaleName() }}  {{-- يعرضلك اسم اللغه المتفعله حاليا --}}
                                            <img src="{{ URL::asset('assets/images/flags/EG.png') }}" alt="">
                                        @else
                                            {{ LaravelLocalization::getCurrentLocaleName() }} {{-- يعرضلك اسم اللغه المتفعله حاليا --}}
                                            <img src="{{ URL::asset('assets/images/flags/US.png') }}" alt="">
                                        @endif
                                    </button>
                                    <div class="dropdown-menu">
                                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                {{ $properties['native'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>

                                <li class="nav-item">
                                    <a href="{{route('category')}}" class="nav-link ml-3"> {{trans('main_trans.Categories')}} </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('cart')}}" class="nav-link ml-3"> {{trans('main_trans.Cart')}}
                                    <span class="badge badge-pill bg-primary cart-count"> 0 </span>
                                    </a>
                                </li>

                            <li class="nav-item dropdown ml-3">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
{{--                                    <li>--}}
{{--                                        <a class="dropdown-item" href="">--}}
{{--                                            MyProfile--}}
{{--                                        </a>--}}
{{--                                    </li>--}}

                                   @if(auth()->user()->role == 1)
                                        <li>
                                            <a class="dropdown-item" href="{{url('dashboard')}}">
                                                {{trans('main_trans.My_Dashboard')}}
                                            </a>
                                        </li>
                                    @endif

                                    <li>
                                        <a class="dropdown-item" href="{{route('my-order')}}">
                                            {{trans('main_trans.MyOrders')}}
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{trans('main_trans.Logout')}}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>

                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

     <div class="container">
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    </div>

    @if(Auth::check())
    <div class="whatsapp-chat">
        <a href="https://wa.me/+201092366331?text=I'm%20interested%20in%20your%20car%20for%20sale" target="_blank">
            <img src="{{asset('frontend/img/whatsApp-logo.png')}}" alt="whatsapp-logo" height="75px" width="75px">
        </a>
    </div>

        @include('layouts.footer')

    @endif

    <!-- Scripts -->
    {{--  owlcarousel  --}}
    <script src="{{ asset('frontend/js/jquery.js') }}"></script>

    <!-- jquery -->
    <script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <!-- plugins-jquery -->
    <script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>

{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
    <script src="{{ asset('frontend/js/bootstrap5.js') }}" defer></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>

    <!--     Font Awesome and icons     -->
    <script src="{{URL::asset('admin/assets/js/all.min.js')}}"></script>

    <script src="{{ asset('frontend/js/custom.js') }}" defer></script>
    <script src="{{ asset('frontend/js/checkout.js') }}" defer></script>

    @if(Auth::check())

        {{--   Start Counter Number --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js" integrity="sha512-CEiA+78TpP9KAIPzqBvxUv8hy41jyI3f2uHi7DGp/Y/Ka973qgSdybNegWFciqh6GrN2UePx2KkflnQUbUhNIA==" crossorigin="anonymous"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js" integrity="sha512-d8F1J2kyiRowBB/8/pAWsqUl0wSEOkG5KATkVV4slfblq9VRQ6MyDZVxWl2tWd+mPhuCbpTB4M7uU/x9FlgQ9Q==" crossorigin="anonymous"></script>

        <script>
            $('.number').counterUp({
                delay: 10,
                time: 1000
            });
        </script>
    @endif

{{-- Search product in laravel | Ajax auto complete  --}}
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <script>

            var availableTags = [];

            $.ajax({
                method: "get",
                url: "/product-list",
                success: function (response) {
                    startAutoComplete(response);
                }
            });
            function startAutoComplete(availableTags) {
                $("#search_product").autocomplete({
                    source: availableTags
                });
            }
    </script>


{{--   End Counter Number --}}
    @yield('script')

{{--    @toastr_js--}}
{{--    @toastr_render--}}
</body>
</html>
