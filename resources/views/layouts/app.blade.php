<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chic & Co. | @yield('title', 'Soft Luxury')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @yield('styles')
</head>

<body class="d-flex flex-column min-vh-100" x-data="{ 
    cartOpen: false, 
    toastMessage: '', 
    showToast: false,
    addToCart(item) {
        this.toastMessage = 'Added ' + item + ' to bag ✨';
        this.showToast = true;
        setTimeout(() => this.showToast = false, 3000);
        this.cartOpen = true;
    }
}">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top bg-ivory/80 backdrop-blur"
        style="background-color: rgba(250, 247, 244, 0.9); border-bottom: 1px solid rgba(0,0,0,0.05);">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"
                style="font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 700;">
                Chic & Co.
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/shop') }}">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/styles') }}">Styles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/new-in') }}">New In</a>
                    </li>
                </ul>
                <div class="d-flex gap-3 align-items-center">
                    <a href="#" class="text-decoration-none text-dark"><i class="fa-regular fa-heart"></i> List</a>
                    <a href="#" @click.prevent="cartOpen = true"
                        class="text-decoration-none text-dark position-relative">
                        <i class="fa-solid fa-bag-shopping"></i> Cart
                        <span
                            class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"
                            style="width: 8px; height: 8px;"></span>
                    </a>
                    <a href="{{ url('/login') }}" class="btn btn-sm btn-secondary-custom">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Slide-in Cart (Offcanvas) -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCart" :class="{ 'show': cartOpen }"
        :style="cartOpen ? 'visibility: visible' : ''" aria-labelledby="offcanvasCartLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasCartLabel" style="font-family: 'Playfair Display', serif;">Your Bag
                (2)</h5>
            <button type="button" class="btn-close" @click="cartOpen = false" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <!-- Cart Items -->
            <div class="flex-grow-1">
                <div class="d-flex gap-3 mb-4">
                    <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?ixlib=rb-4.0.3&w=100&q=80"
                        class="rounded" width="70" alt="">
                    <div>
                        <h6 class="mb-0">Rose Gold Silk Abaya</h6>
                        <small class="text-muted">Size: M</small>
                        <div class="d-flex justify-content-between align-items-center mt-1" style="width: 180px;">
                            <span class="fw-bold">149 JOD</span>
                            <div class="input-group input-group-sm w-50">
                                <button class="btn btn-outline-secondary px-2">-</button>
                                <input type="text" class="form-control text-center p-0" value="1">
                                <button class="btn btn-outline-secondary px-2">+</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-3 mb-4">
                    <img src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?ixlib=rb-4.0.3&w=100&q=80"
                        class="rounded" width="70" alt="">
                    <div>
                        <h6 class="mb-0">Studded Mini Bag</h6>
                        <small class="text-muted">Black</small>
                        <div class="d-flex justify-content-between align-items-center mt-1" style="width: 180px;">
                            <span class="fw-bold">45 JOD</span>
                            <div class="input-group input-group-sm w-50">
                                <button class="btn btn-outline-secondary px-2">-</button>
                                <input type="text" class="form-control text-center p-0" value="1">
                                <button class="btn btn-outline-secondary px-2">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="border-top pt-3">
                <div class="d-flex justify-content-between mb-3">
                    <span class="h6">Subtotal</span>
                    <span class="h6">194 JOD</span>
                </div>
                <!-- Simulating waiting for button click -->
                <a href="{{ url('/checkout') }}" class="btn btn-primary-custom w-100">Checkout</a>
                <div class="text-center mt-2">
                    <a href="{{ url('/cart') }}" class="text-muted small text-decoration-none">View full bag</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Backdrop -->
    <div class="offcanvas-backdrop fade show" x-show="cartOpen" @click="cartOpen = false" x-transition.opacity></div>

    <!-- Toast Notification -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1060">
        <div class="toast align-items-center text-white bg-dark border-0" :class="{ 'show': showToast }" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" x-text="toastMessage"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" @click="showToast = false"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5 mt-auto">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h5 style="font-family: 'Playfair Display', serif;">Chic & Co.</h5>
                    <p class="text-muted small">Curated fashion for Soft Girls, Alt Girls, and Ammani Luxury.</p>
                </div>
                <div class="col-md-2">
                    <h6>Shop</h6>
                    <ul class="list-unstyled text-muted small">
                        <li><a href="#" class="text-reset text-decoration-none">New In</a></li>
                        <li><a href="#" class="text-reset text-decoration-none">Clothing</a></li>
                        <li><a href="#" class="text-reset text-decoration-none">Accessories</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h6>Help</h6>
                    <ul class="list-unstyled text-muted small">
                        <li><a href="#" class="text-reset text-decoration-none">Shipping</a></li>
                        <li><a href="#" class="text-reset text-decoration-none">Returns</a></li>
                        <li><a href="#" class="text-reset text-decoration-none">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6>Subscribe</h6>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Email address">
                        <button class="btn btn-outline-light" type="button">Join</button>
                    </div>
                </div>
            </div>
            <hr class="border-secondary my-4">
            <div class="d-flex justify-content-between small text-muted">
                <span>&copy; {{ date('Y') }} Chic & Co. All rights reserved.</span>
                <div>
                    <span class="me-3">Insta</span>
                    <span>TikTok</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- FontAwesome (via CDN for simplicity as requested/implied setup) -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Note: User asked for Font Awesome 6. Using a reliable CDN or I should assume npm. 
         I'll add a generic CDN link for now since I don't have the user's kit code. 
         Actually, let's use a standard public CDN for FA6 free. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @yield('scripts')
</body>

</html>