<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Chic & Co.</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --color-warm-ivory: #F5F5F0;
            --color-ink-black: #1E1E1E;
        }

        body {
            background-color: #F8F9FA;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: white;
            border-right: 1px solid #eee;
            padding: 20px;
        }

        .main-content {
            margin-left: 250px;
            padding: 30px;
        }

        .nav-link {
            color: #1E1E1E;
            padding: 10px 15px;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .nav-link:hover {
            background-color: #f8f9fa;
        }

        .nav-link.active {
            background-color: var(--color-warm-ivory);
            color: var(--color-ink-black);
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h4 class="mb-4 ps-2" style="font-family: 'Playfair Display', serif;">Chic Admin</h4>
        <ul class="nav flex-column gap-2">
            <li class="nav-item">
                <a href="{{ url('/admin/dashboard') }}"
                    class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-line me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.products.index') }}"
                    class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}">
                    <i class="fa-solid fa-box me-2"></i> Products
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}"
                    class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
                    <i class="fa-solid fa-list me-2"></i> Categories
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/orders') }}"
                    class="nav-link {{ request()->is('admin/orders*') ? 'active' : '' }}">
                    <i class="fa-solid fa-cart-shopping me-2"></i> Orders
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/users') }}"
                    class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users me-2"></i> Users
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/reviews') }}"
                    class="nav-link {{ request()->is('admin/reviews*') ? 'active' : '' }}">
                    <i class="fa-solid fa-star me-2"></i> Reviews
                </a>
            </li>
        </ul>

        <div class="mt-auto border-top pt-3 position-absolute bottom-0 w-100 start-0 px-4 pb-4">
            <div class="mb-3 ps-2">
                <small class="text-muted d-block uppercase" style="font-size: 0.7rem;">Logged in as:</small>
                <div class="fw-bold text-dark">{{ Auth::user()->name ?? 'Guest' }}</div>
            </div>
            <a href="{{ url('/') }}" class="text-muted text-decoration-none small mb-2 d-block"><i
                    class="fa-solid fa-arrow-left me-2"></i> Back to Shop</a>

            <a href="{{ route('logout') }}" class="text-danger text-decoration-none"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-sign-out-alt me-2"></i> Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>

    <div class="main-content">
        @yield('content')
    </div>
</body>

</html>