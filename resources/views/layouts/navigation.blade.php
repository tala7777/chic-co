@php
    /** @var \App\Models\User $user */
    $user = Auth::user();
@endphp
<nav class="navbar navbar-expand-md navbar-light fixed-top">
    <div class="container px-4 px-md-2">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <i class="fa-solid fa-gem me-2" style="font-size: 1.2rem; color: var(--color-primary-blush);"></i>
            <span class="font-heading fw-bold ls-1">CHIC & CO.</span>
        </a>

        <!-- Mobile Toggle (Order 3 on mobile) -->
        <button class="navbar-toggler border-0 order-2 ms-3 shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent">
            <i class="fa-solid fa-bars-staggered"></i>
        </button>

        <!-- Utility Group (Always Visible - Order 2 on mobile, Order 3 on desktop) -->
        <div class="d-flex align-items-center gap-3 order-1 order-md-3 ms-auto ms-md-0">
            <!-- Search (Hidden on mobile) -->
            <div class="search-container d-none d-md-block">
                <form action="{{ route('shop.index') }}" method="GET">
                    @foreach(['aesthetic', 'price_tier', 'sort'] as $param)
                        @if(request($param))
                            <input type="hidden" name="{{ $param }}" value="{{ request($param) }}">
                        @endif
                    @endforeach
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" name="search" class="search-input shadow-none" placeholder="The Collection..."
                        value="{{ request('search') }}">
                </form>
            </div>

            <!-- Wishlist -->
            <a href="{{ route('account.wishlist') }}" class="utility-icon" title="Wishlist">
                <i class="fa-regular fa-heart"></i>
            </a>

            <livewire:cart-count />

            <!-- User Menu -->
            <div class="nav-item m-0">
                @guest
                    <a href="{{ route('login') }}" class="utility-icon" title="Login">
                        <i class="fa-regular fa-user"></i>
                    </a>
                @else
                    <a href="{{ $user->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}"
                        class="utility-icon" title="My Account">
                        <i class="fa-solid fa-user-check" style="color: var(--color-primary-blush);"></i>
                    </a>
                @endguest
            </div>
        </div>

        <!-- Links (Collapse - Order 3 on mobile, Order 2 on desktop) -->
        <div class="collapse navbar-collapse order-3 order-md-2" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('shop') && !request('sort') ? 'active' : '' }}"
                        href="{{ route('shop.index') }}">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('sort') === 'latest' ? 'active' : '' }}"
                        href="{{ route('shop.index', ['sort' => 'latest']) }}">New In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('style-quiz') ? 'active' : '' }}"
                        href="{{ route('sparkle.quiz') }}">Quiz</a>
                </li>
                @if(auth()->check() || session()->has('user_aesthetic'))
                    <li class="nav-item ms-md-2">
                        <a class="nav-link {{ Request::routeIs('personalized.feed') ? 'active' : '' }} px-4 bg-primary-subtle rounded-pill transition-premium"
                            href="{{ route('personalized.feed') }}"
                            style="color: var(--color-ink-black) !important; opacity: 1 !important;">
                            <i class="fa-solid fa-sparkles me-2 text-primary"></i> The Universe
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>