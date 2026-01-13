<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Chic & Co.') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts and CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .nav-link {
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
            color: var(--color-ink-black) !important;
            padding: 0.5rem 1rem !important;
        }

        .navbar {
            padding: 1.5rem 0;
            background: rgba(250, 247, 244, 0.8) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    CHIC & CO.
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item"><a class="nav-link" href="{{ url('/shop') }}">Shop</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/new-in') }}">New In</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/styles') }}">Styles</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link btn btn-primary-custom text-white ms-md-2" href="{{ route('register') }}"
                                        style="font-size: 0.75rem; padding: 8px 20px !important;">Join Us</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa-regular fa-user me-1"></i> {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end border-0 shadow-sm"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item py-2" href="{{ url('/dashboard') }}">Dashboard</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item py-2 text-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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

        <main style="padding-top: 100px;">
            @yield('content')
        </main>

        <footer class="py-5 mt-5 bg-white border-top">
            <div class="container text-center">
                <h4 class="mb-4">CHIC & CO.</h4>
                <p class="text-muted small mb-4">Elevating everyday aesthetics with curated fashion.</p>
                <div class="d-flex justify-content-center gap-4 mb-4">
                    <a href="#" class="text-dark"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="text-dark"><i class="fa-brands fa-pinterest"></i></a>
                    <a href="#" class="text-dark"><i class="fa-brands fa-tiktok"></i></a>
                </div>
                <p class="text-muted" style="font-size: 0.7rem;">&copy; {{ date('Y') }} CHIC & CO. All Rights Reserved.
                </p>
            </div>
        </footer>
    </div>
</body>

</html>