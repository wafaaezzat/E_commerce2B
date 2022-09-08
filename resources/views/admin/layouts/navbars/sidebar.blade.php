<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo">
        <a href="{{ url('/dashboard') }}" class="simple-text logo-normal">
            {{ __('E-Shop') }}
            <img src="https://smhttp-ssl-73217.nexcesscdn.net/pub/media/logo/stores/2/logo.png" alt="Welcome to 2B" style="width: 60px; height: 60px" alt="...">
        </a>

    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
                <a class="nav-link" href="{{ url('dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>

            {{--  Site   --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">
                    <i class="material-icons">dashboard</i>
                    <p> {{ __('Site') }}</p>
                </a>
            </li>

            {{--  Categories  --}}
            <li class="nav-item dropdown {{ ($activePage == 'categories' || $activePage == 'add-category') ? ' active' : '' }}">
                <style>
                    .dropdown-toggle::after{
                        border-top: 0 ;
                    }
                </style>
                <a id="navbardropdown" class="nav-link dropdown-toggle"  href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <i><img style="width:25px" src="{{URL::asset('admin/assets/img/laravel.svg')}}"></i>
                    <p> {{ __('Categories') }}
                        {{--                           {{trans('Categories_Trans.Categories')}}--}}
                        <b class="caret"></b>
                    </p>
                </a>

                <ul class="dropdown-menu" aria-labelledby="navbardropdown">

                    <li class="nav-item{{ $activePage == 'categories' ? ' active' : '' }}">
                        <a class="dropdown-item nav-link" href="{{ url('categories') }}">
                            <i class="material-icons">content_paste</i>
                            <span class="sidebar-normal">{{ __('Categories') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'add-category' ? ' active' : '' }}">
                        <a class="dropdown-item nav-link" href="{{ url('add-category') }}">
                            <i class="material-icons">content_paste</i>
                            <p>{{ __('Add Categories') }}</p>
                        </a>
                    </li>

                </ul>

            </li>

            {{--  Products   --}}
            <li class="nav-item dropdown {{ ($activePage == 'products' || $activePage == 'add-product') ? ' active' : '' }}">
                <style>
                    .dropdown-toggle::after{
                        border-top: 0 ;
                    }
                </style>
                <a id="navbardropdown" class="nav-link dropdown-toggle"  href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <i><img style="width:25px" src="{{URL::asset('admin/assets/img/laravel.svg')}}"></i>
                    <p> {{ __('Products') }}
                        <b class="caret"></b>
                    </p>
                </a>

                <ul class="dropdown-menu" aria-labelledby="navbardropdown">

                    <li class="nav-item{{ $activePage == 'products' ? ' active' : '' }}">
                        <a class="dropdown-item nav-link" href="{{ url('products') }}">
                            <i class="material-icons">content_paste</i>
                            <span class="sidebar-normal">{{ __('Products') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'add-product' ? ' active' : '' }}">
                        <a class="dropdown-item nav-link" href="{{ route('products.create') }}">
                            <i class="material-icons">content_paste</i>
                            <p>{{ __('Add Products') }}</p>
                        </a>
                    </li>

                </ul>

            </li>


            {{--  orders   --}}
            <li class="nav-item dropdown {{ ($activePage == 'orders' || $activePage == 'orders') ? ' active' : '' }}">
                <style>
                    .dropdown-toggle::after{
                        border-top: 0 ;
                    }
                </style>
                <a id="navbardropdown" class="nav-link dropdown-toggle"  href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <i><img style="width:25px" src="{{URL::asset('admin/assets/img/laravel.svg')}}"></i>
                    <p> {{ __('Orders') }}
                        <b class="caret"></b>
                    </p>
                </a>

                <ul class="dropdown-menu" aria-labelledby="navbardropdown">

                    <li class="nav-item{{ $activePage == 'orders' ? ' active' : '' }}">
                        <a class="dropdown-item nav-link" href="{{ url('orders') }}">
                            <i class="material-icons">content_paste</i>
                            <span class="sidebar-normal">{{ __('Orders') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'ordersHistory' ? ' active' : '' }}">
                        <a class="dropdown-item nav-link" href="{{ route('ordersHistory') }}">
                            <i class="material-icons">content_paste</i>
                            <p>{{ __('ordersHistory') }}</p>
                        </a>
                    </li>
                </ul>

            </li>

            {{--  Start Contacts   --}}
            <li class="nav-item dropdown {{ ($activePage == 'Contacts' || $activePage == 'Contacts') ? ' active' : '' }}">
                <style>
                    .dropdown-toggle::after{
                        border-top: 0 ;
                    }
                </style>
                <a id="navbardropdown" class="nav-link dropdown-toggle"  href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <i><img style="width:25px" src="{{URL::asset('admin/assets/img/laravel.svg')}}"></i>
                    <p> {{ __('Contacts') }}
                        <b class="caret"></b>
                    </p>
                </a>

                <ul class="dropdown-menu" aria-labelledby="navbardropdown">

                    <li class="nav-item{{ $activePage == 'Contacts' ? ' active' : '' }}">
                        <a class="dropdown-item nav-link" href="{{ url('Contacts') }}">
                            <i class="material-icons">content_paste</i>
                            <span class="sidebar-normal">{{ __('Contacts') }} </span>
                        </a>
                    </li>
                    {{--                <li class="nav-item{{ $activePage == 'ordersHistory' ? ' active' : '' }}">--}}
                    {{--                    <a class="dropdown-item nav-link" href="{{ route('ordersHistory') }}">--}}
                    {{--                        <i class="material-icons">content_paste</i>--}}
                    {{--                        <p>{{ __('ordersHistory') }}</p>--}}
                    {{--                    </a>--}}
                    {{--                </li>--}}
                </ul>

            </li>
            {{--  End Contacts   --}}

            {{--  users   --}}
            <li class="nav-item{{ $activePage == 'users' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('users') }}">
                    <i class="material-icons">persons</i>
                    <p>{{ __('Users') }}</p>
                </a>
            </li>

            <li class="nav-item{{ $activePage == 'logout' ? ' active' : '' }}">
                <a class="nav-link" href="{{route('logout')}}"
                   onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="material-icons">Logout</i>
                    <p>{{ __('Logout') }}</p>
                </a>
                {{--                      <i class="fas fa-sign-out-alt"></i>Logout</a>--}}
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>

        </ul>
    </div>
</div>
