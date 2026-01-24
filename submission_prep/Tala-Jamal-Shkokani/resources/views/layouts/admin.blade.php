<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin Dashboard' }} | Chic & Co.</title>

    <!-- Google Fonts -->
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&display=swap"
        rel="stylesheet">


    <!-- Scripts and CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            /* Refined "Blush Luxe Noir" Palette */
            --color-primary-blush: #E87A90;
            --color-secondary-mauve: #C68CA0;
            --color-ink-black: #1A1A1A;
            --color-charcoal: #2F2F2F;
            --color-warm-gold: #D4AF37;
            --color-ivory: #FDFAF5;
            --color-cloud: #F8F5F2;
            --color-sage: #DCE8E6;

            /* Legacy mapping compatibility */
            --color-dusty-rose: var(--color-secondary-mauve);
            --color-warm-ivory: var(--color-ivory);

            --font-heading: 'Playfair Display', serif;
            --font-body: 'Lato', sans-serif;
        }

        body {
            background-color: var(--color-warm-ivory);
            font-family: var(--font-body);
            color: var(--color-ink-black);
            overflow-x: hidden;
        }

        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #ffffff;
            border-right: 1px solid rgba(0, 0, 0, 0.05);
            padding: 2.5rem 1.5rem;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .main-content {
            margin-left: 280px;
            padding: 3rem 4rem;
            min-height: 100vh;
            background-color: #FDFBFA;
        }

        .brand-logo {
            font-family: var(--font-heading);
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 3rem;
            color: var(--color-ink-black);
            text-decoration: none;
            display: flex;
            align-items: center;
            letter-spacing: 1px;
        }

        .nav-section-label {
            font-size: 0.65rem;
            font-weight: 800;
            letter-spacing: 2px;
            color: #999;
            margin-bottom: 1.2rem;
            padding-left: 1rem;
            text-transform: uppercase;
        }

        .nav-link {
            color: #666;
            padding: 0.85rem 1.2rem;
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 0.5rem;
            text-transform: none !important;
            letter-spacing: 0 !important;
        }

        .nav-link i {
            width: 20px;
            font-size: 1rem;
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background-color: rgba(246, 166, 178, 0.08);
            color: var(--color-primary-blush);
            transform: translateX(5px);
        }

        .nav-link:hover i {
            opacity: 1;
            transform: scale(1.1);
        }

        .nav-link.active {
            background: var(--color-ink-black);
            color: white !important;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .nav-link.active i {
            color: var(--color-primary-blush);
            opacity: 1;
        }

        .nav-badge {
            background: rgba(0, 0, 0, 0.05);
            color: #666;
            font-size: 0.7rem;
            padding: 2px 8px;
            border-radius: 8px;
            font-weight: 700;
            margin-left: auto;
        }

        .nav-link.active .nav-badge {
            background: rgba(246, 166, 178, 0.2);
            color: var(--color-primary-blush);
        }

        .card {
            border-radius: 24px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
            transition: all 0.3s ease;
        }

        .btn-luxury {
            background-color: var(--color-ink-black);
            color: white;
            border-radius: 100px;
            padding: 12px 28px;
            font-weight: 600;
            letter-spacing: 0.5px;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-luxury:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            background-color: #333;
            color: white;
        }

        /* Stats Pulse */
        @keyframes pulse-soft {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.02);
            }

            100% {
                transform: scale(1);
            }
        }

        .stat-card:hover {
            animation: pulse-soft 2s infinite ease-in-out;
        }

        .animate-fade-in {
            animation: fadeIn 0.8s cubic-bezier(0.23, 1, 0.32, 1);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .admin-profile-card {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: #F8F9FA;
            border-radius: 16px;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .admin-profile-card:hover {
            background: #fff;
            border-color: rgba(0, 0, 0, 0.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transform: translateY(-2px);
        }

        .profile-avatar {
            width: 45px;
            height: 45px;
            background: var(--color-ink-black);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
            margin-right: 12px;
        }

        .profile-info {
            flex: 1;
        }

        .profile-name {
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--color-ink-black);
            line-height: 1.2;
        }

        .profile-role {
            font-size: 0.7rem;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .logout-link {
            color: #dc3545 !important;
            margin-top: 5px;
        }

        .logout-link:hover {
            background-color: #fff5f5;
            color: #bd2130 !important;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body>
    <div class="sidebar animate-fade-in">
        <a href="{{ url('/') }}" class="brand-logo">
            <i class="fa-solid fa-gem me-2"></i>CHIC & CO.
        </a>

        <div class="nav-section-label">MAIN MENU</div>

        <ul class="nav flex-column flex-grow-1">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" wire:navigate
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.products.index') }}" wire:navigate
                    class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span>Products</span>
                    <span class="nav-badge">{{ \App\Models\Product::count() }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}" wire:navigate
                    class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.orders.index') }}" wire:navigate
                    class="nav-link {{ request()->is('admin/orders*') ? 'active' : '' }}">
                    <i class="fa-solid fa-receipt"></i>
                    <span>Orders</span>
                    @php
                        $pendingCount = \App\Models\Order::where('status', 'pending')->count();
                    @endphp
                    @if($pendingCount > 0)
                        <span class="nav-badge badge-warning">{{ $pendingCount }}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" wire:navigate
                    class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-group"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.reviews.index') }}" wire:navigate
                    class="nav-link {{ request()->is('admin/reviews*') ? 'active' : '' }}">
                    <i class="fa-solid fa-star"></i>
                    <span>Reviews</span>
                </a>
            </li>
            <li class="nav-item border-top mt-3 pt-3">
                <a href="{{ route('admin.account') }}" wire:navigate
                    class="nav-link {{ request()->routeIs('admin.account') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-gear"></i>
                    <span>Account Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link logout-link"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Sign Out</span>
                </a>
            </li>
        </ul>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

    <div class="main-content">
        {{ $slot ?? '' }}
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 Handlers -->
    <script>
        const softSwal = {
            confirmButtonColor: '#F6A6B2',
            background: '#FDFBFA',
            color: '#1E1E1E',
            customClass: {
                popup: 'soft-alert-popup',
                title: 'soft-alert-title',
                confirmButton: 'soft-alert-button'
            }
        };

        window.addEventListener('swal:success', event => {
            const data = event.detail[0];
            Swal.fire({
                ...softSwal,
                title: data.title,
                text: data.text,
                icon: 'success',
                iconColor: '#F6A6B2'
            });
        });

        window.addEventListener('swal:error', event => {
            const data = event.detail[0];
            Swal.fire({
                ...softSwal,
                title: data.title,
                text: data.text,
                icon: 'error',
                confirmButtonColor: '#1E1E1E'
            });
        });

        function confirmDelete(id, method, title = 'Are you sure?', text = "You won't be able to revert this!") {
            Swal.fire({
                ...softSwal,
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1E1E1E',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Logic handled via AlpineJS wrapper below
                }
            });
        }

        // AlpineJS Helper for Confirmation
        document.addEventListener('alpine:init', () => {
            Alpine.data('confirmAction', () => ({
                confirm(method, params, title, text) {
                    Swal.fire({
                        ...softSwal,
                        title: title || 'Are you sure?',
                        text: text || "This action cannot be undone.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, proceed',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.$wire[method](params);
                        }
                    });
                }
            }));
        });
    </script>

    <style>
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        :root {
            --color-primary-blush: #F6A6B2;
            --color-dusty-rose: #E48B9A;
            --color-ink-black: #1E1E1E;
            --color-warm-ivory: #FDFBFA;
        }
    </style>

</body>

</html>