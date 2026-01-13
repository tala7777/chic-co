<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard | Chic & Co.</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">

    <!-- Scripts and CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #FDFBFA;
            font-family: 'Inter', sans-serif;
        }

        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: white;
            border-right: 1px solid rgba(0, 0, 0, 0.05);
            padding: 2rem;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .main-content {
            margin-left: 280px;
            padding: 3rem;
            min-height: 100vh;
        }

        .nav-link {
            color: #666;
            padding: 0.8rem 1.2rem;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
            text-transform: none !important;
            letter-spacing: normal !important;
        }

        .nav-link i {
            width: 20px;
            margin-right: 12px;
            font-size: 1.1rem;
        }

        .nav-link:hover {
            background-color: var(--color-warm-ivory);
            color: var(--color-ink-black);
            transform: translateX(5px);
        }

        .nav-link.active {
            background-color: var(--color-ink-black);
            color: white !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .brand-logo {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 3rem;
            color: var(--color-ink-black);
            text-decoration: none;
            display: block;
        }

        .card {
            border-radius: 20px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
        }

        .btn-primary {
            background-color: var(--color-ink-black);
            border: none;
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #333;
        }
    </style>
</head>

<body>
    <div class="sidebar animate-fade-in">
        <a href="{{ url('/') }}" class="brand-logo">CHIC & CO.</a>

        <ul class="nav flex-column flex-grow-1">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-house"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.products.index') }}"
                    class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}">
                    <i class="fa-solid fa-bag-shopping"></i> Products
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}"
                    class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
                    <i class="fa-solid fa-layer-group"></i> Categories
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.orders.index') }}"
                    class="nav-link {{ request()->is('admin/orders*') ? 'active' : '' }}">
                    <i class="fa-solid fa-receipt"></i> Orders
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}"
                    class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-group"></i> Users
                </a>
            </li>
        </ul>

        <div class="mt-auto border-top pt-4">
            <div class="d-flex align-items-center mb-4 ps-2">
                <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                    style="width: 40px; height: 40px; font-weight: 700;">
                    {{ substr(Auth::user()->name ?? 'G', 0, 1) }}
                </div>
                <div>
                    <div class="fw-bold small text-dark">{{ Auth::user()->name ?? 'Guest User' }}</div>
                    <small class="text-muted" style="font-size: 0.7rem;">Administrator</small>
                </div>
            </div>

            <a href="{{ route('logout') }}" class="nav-link text-danger p-0"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Sign Out
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>

    <div class="main-content">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>