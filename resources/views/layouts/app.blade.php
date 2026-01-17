<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<style>
    .navbar-brand,
    .nav-link {
        color: #e5c68d !important;
    }

    .nav-link:hover,
    .navbar-brand:hover {
        color: #e5c68d !important;
    }
    .app-icon-wrapper {
    width: 60px;
    height: 60px;
    border: 1px solid #82755a;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden; /* ← 超重要 */
    }

    .app-icon-img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* ← はみ出し防止 */
    }
    .home-search-bar {
        background-color: #e5c68d
    }
    .search-bar-input{
        background-color: #e5c68d
    }
    .search-bar-btn{
        background-color: #fce9b9;
    }
    .search-bar-btn:hover{
        background-color: #e5c68d;
    }
    .input-group-text{
        border: none;
        background-color: #e7d4b0;
    }
</style>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm py-1">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/home') }}">
                    @guest
                        WonderStay
                    @else
                        <div class="app-icon-wrapper">
                            <img src="{{ asset('images/WonderStay.png') }}"
                                alt="WonderStay"
                                class="app-icon-img"
                                >
                        </div>
                    @endguest
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar --> <!--search bar-->
                    <div class="container py-3">
                        <form class="mx-auto" style="max-width: 700px;">
                            <div class="input-group shadow-sm rounded-4 overflow-hidden border" style="height: 50px;">
                            <!-- Check in -->
                            <span class="input-group-text border-0">
                                <span class="text-secondary small">{{ __('DATE FOR CHECK-IN') }}</span>
                            </span>
                            <input type="date" class="form-control border-0 shadow-none text-dark" aria-label="checkin">

                            <!-- Check out -->
                            <span class="input-group-text border-0">
                                <span class="text-secondary small">{{ __('DATE FOR CHECK-OUT') }}</span>
                            </span>
                            <input type="date" class="form-control border-0 shadow-none text-dark" aria-label="checkout">

                            <!-- Search -->
                            <button class="btn px-4 fw-semibold search-bar-btn" type="button">
                                <i class="bi bi-search" style="color: black"></i>
                            </button>
                            </div>
                        </form>
                    </div>


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
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                    {{ currentLanguage()->native_name ?? 'Language' }}
                                </a>

                                <ul class="dropdown-menu">
                                    @foreach (languages() as $language)
                                        <li>
                                            <a class="dropdown-item"
                                            href="{{ route('language.switch', $language->code) }}">
                                                {{ $language->native_name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li>
                                <!--Currency button-->
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
