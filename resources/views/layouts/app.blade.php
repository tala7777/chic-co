<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Chic & Co.' }} | {{ config('app.name', 'Wonderland') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts and CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --nav-height: 80px;
            --color-primary-blush: #F6A6B2;
            --color-dusty-rose: #E48B9A;
            --color-ink-black: #1E1E1E;
            --color-warm-ivory: #FDFBFA;
            --font-heading: 'Playfair Display', serif;
            --font-body: 'Inter', sans-serif;
            --shadow-premium: 0 10px 40px rgba(0, 0, 0, 0.04);
            --transition-premium: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        }

        body {
            font-family: var(--font-body);
            color: var(--color-ink-black);
            background-color: var(--color-warm-ivory);
            cursor: default;
            overflow-x: hidden !important;
        }

        /* Typography */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .font-heading {
            font-family: var(--font-heading);
            font-weight: 700;
            color: var(--color-ink-black);
        }

        p,
        span,
        label,
        div {
            cursor: default;
        }

        .ls-1 {
            letter-spacing: 1px;
        }

        .ls-2 {
            letter-spacing: 2px;
        }

        /* Buttons */
        .btn-premium {
            background-color: var(--color-ink-black);
            color: white !important;
            border-radius: 100px;
            font-weight: 600;
            padding: 14px 32px !important;
            border: none;
            transition: var(--transition-premium);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .btn-premium:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
            background-color: #333;
            color: white !important;
        }

        .btn-premium-outline {
            background: transparent;
            color: var(--color-ink-black) !important;
            border: 1px solid var(--color-ink-black);
            border-radius: 100px;
            font-weight: 600;
            padding: 14px 32px !important;
            transition: var(--transition-premium);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .btn-premium-outline:hover {
            background: var(--color-ink-black);
            color: white !important;
            transform: translateY(-2px);
        }

        .btn-soft {
            background: var(--color-primary-blush);
            color: white !important;
            border-radius: 100px;
            font-weight: 600;
            padding: 12px 28px !important;
            border: none;
            transition: var(--transition-premium);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .btn-soft:hover {
            background: var(--color-dusty-rose);
            box-shadow: 0 10px 25px rgba(246, 166, 178, 0.3);
            transform: translateY(-2px);
            color: white !important;
        }

        /* Forms */
        .form-control,
        .form-select {
            border-radius: 100px !important;
            padding: 14px 24px !important;
            border: 1px solid rgba(0, 0, 0, 0.08) !important;
            background-color: #f8f9fa !important;
            font-size: 0.95rem !important;
            transition: var(--transition-premium) !important;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: white !important;
            border-color: var(--color-primary-blush) !important;
            box-shadow: 0 0 0 4px rgba(246, 166, 178, 0.1) !important;
            outline: none !important;
        }

        /* Cards */
        .card-premium {
            background: white;
            border: none;
            border-radius: 32px;
            box-shadow: var(--shadow-premium);
            transition: var(--transition-premium);
            overflow: hidden;
        }

        .card-premium:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.05);
        }

        /* Navbar Refinement */
        .navbar {
            height: var(--nav-height);
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.95) !important;
            height: calc(var(--nav-height) - 15px);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
        }

        .navbar-brand {
            font-family: var(--font-heading);
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 1px;
            transition: var(--transition-premium);
        }

        .nav-link {
            text-transform: uppercase;
            font-size: 0.72rem !important;
            font-weight: 600 !important;
            letter-spacing: 1.8px !important;
            padding: 0.5rem 1.5rem !important;
            opacity: 0.7;
            transition: var(--transition-premium);
            color: var(--color-ink-black) !important;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--color-primary-blush);
            transition: var(--transition-premium);
            transform: translateX(-50%);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 20px;
        }

        .nav-link:hover,
        .nav-link.active {
            opacity: 1;
            color: var(--color-ink-black) !important;
        }

        .bg-primary-subtle {
            background-color: rgba(246, 166, 178, 0.1) !important;
            border: 1px solid rgba(246, 166, 178, 0.2);
            box-shadow: 0 0 15px rgba(246, 166, 178, 0.1);
        }

        @keyframes pulse-glow {
            0% {
                box-shadow: 0 0 5px rgba(246, 166, 178, 0.2);
            }

            50% {
                box-shadow: 0 0 15px rgba(246, 166, 178, 0.5);
            }

            100% {
                box-shadow: 0 0 5px rgba(246, 166, 178, 0.2);
            }
        }

        .nav-link.bg-primary-subtle {
            animation: pulse-glow 3s infinite;
        }

        .search-container {
            position: relative;
            width: 200px;
            transition: var(--transition-premium);
        }

        .search-input {
            background: rgba(0, 0, 0, 0.03);
            border: 1px solid transparent;
            border-radius: 100px;
            padding: 8px 15px 8px 35px;
            font-size: 0.8rem;
            width: 100%;
            transition: var(--transition-premium);
        }

        .search-input:focus {
            background: white;
            border-color: rgba(246, 166, 178, 0.3);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            width: 240px;
            outline: none;
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            pointer-events: none;
        }

        .cart-icon-wrapper {
            position: relative;
            display: inline-block;
            margin-left: 15px;
        }

        .cart-badge {
            position: absolute;
            top: -5px;
            right: -8px;
            background: var(--color-ink-black);
            color: white;
            font-size: 0.6rem;
            min-width: 16px;
            height: 16px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* Animations */
        .animate-fade-up {
            animation: fadeUp 0.8s cubic-bezier(0.23, 1, 0.32, 1) forwards;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Selection cursors */
        input,
        textarea,
        [contenteditable="true"] {
            cursor: text !important;
        }

        a,
        button,
        .btn,
        .cursor-pointer,
        [role="button"],
        select {
            cursor: pointer !important;
        }

        .utility-icon {
            font-size: 1.1rem;
            color: var(--color-ink-black);
            transition: var(--transition-premium);
            position: relative;
        }

        .utility-icon:hover {
            transform: scale(1.1);
            color: var(--color-primary-blush);
        }

        main {
            padding-top: calc(var(--nav-height) + 40px);
            min-height: 80vh;
        }
    </style>
</head>

<body>
    <div id="app">
        @include('layouts.navigation')

        <main>
            @if(session('error'))
                <div class="container mt-3">
                    <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm border-0" role="alert"><i
                            class="fa-solid fa-circle-exclamation me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            </div>@endif
            @yield('content')
            {{ $slot ?? '' }}
        </main>
        <footer class="py-5 mt-5 bg-white border-top">
            <div class="container text-center">
                <h4 class="mb-4"><i class="fa-solid fa-gem me-2"></i>CHIC & CO.</h4>
                <p class="text-muted small mb-4">Elevating everyday aesthetics with curated fashion.</p>
                <div class="d-flex justify-content-center gap-4 mb-4"><a href="#" class="text-dark"><i
                            class="fa-brands fa-instagram"></i></a><a href="#" class="text-dark"><i
                            class="fa-brands fa-pinterest"></i></a><a href="#" class="text-dark"><i
                            class="fa-brands fa-tiktok"></i></a></div>
                <p class="text-muted" style="font-size: 0.7rem;">&copy;

                    {{ date('Y') }}
                    CHIC & CO. All Rights Reserved.
                </p>
            </div>
        </footer>
    </div><livewire:cart-sidebar /><livewire:quick-add-to-cart />
    < !-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>window.addEventListener('swal:success', event => {
                const data = event.detail[0];

                Swal.fire({
                    title: data.title,
                    text: data.text,
                    icon: data.icon,
                    confirmButtonColor: '#000',
                    borderRadius: '15px'
                });
            });

            window.addEventListener('open-cart', event => {
                const sidebar = document.getElementById('cartSidebar');

                if (sidebar) {
                    const bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(sidebar);
                    bsOffcanvas.show();
                }
            });

            function triggerReviewModal(productName) {
                Swal.fire({

                    title: 'Review ' + productName,
                    html: ` <div class="mb-3 text-start" > <label class="small text-muted mb-2 d-block" >Your Aesthetic Experience</label> <div class="d-flex gap-2 mb-3 fs-3" id="star-rating" > <i class="fa-regular fa-star cursor-pointer" onclick="setRating(1)" ></i> <i class="fa-regular fa-star cursor-pointer" onclick="setRating(2)" ></i> <i class="fa-regular fa-star cursor-pointer" onclick="setRating(3)" ></i> <i class="fa-regular fa-star cursor-pointer" onclick="setRating(4)" ></i> <i class="fa-regular fa-star cursor-pointer" onclick="setRating(5)" ></i> </div> <textarea class="form-control border-0 bg-light rounded-4 p-3" rows="3" placeholder="Describe your experience with this piece..." ></textarea> </div> `,
                    showCancelButton: true,
                    confirmButtonText: 'Submit Review',
                    confirmButtonColor: '#000',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        popup: 'rounded-5'
                    }

                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Thank You!',
                            text: 'Your review has been shared with the community.',
                            icon: 'success',
                            confirmButtonColor: '#000'
                        });
                    }
                });
            }

            function setRating(val) {
                const stars = document.querySelectorAll('#star-rating i');

                stars.forEach((star, index) => {
                    if (index < val) {
                        star.classList.replace('fa-regular', 'fa-solid');
                        star.classList.add('text-warning');
                    }

                    else {
                        star.classList.replace('fa-solid', 'fa-regular');
                        star.classList.remove('text-warning');
                    }
                });
            }

        </script>
        <script> // Global Backdrop & Scroll Lock Reaper
            // Ensures the page never gets stuck in a "dark/disabled" state
            document.addEventListener('livewire:navigated', cleanupUIState);
            document.addEventListener('hidden.bs.offcanvas', cleanupUIState);
            document.addEventListener('hidden.bs.modal', cleanupUIState);

            function cleanupUIState() {

                // Give a tiny timeout for animations to finish
                setTimeout(() => {
                    const activeOffcanvas = document.querySelector('.offcanvas.show');
                    const activeModal = document.querySelector('.modal.show');

                    // If nothing is supposedly open, purge all leftovers
                    if (!activeOffcanvas && !activeModal) {
                        // Remove all backdrops
                        document.querySelectorAll('.offcanvas-backdrop, .modal-backdrop').forEach(el => el.remove());
                        // Restore body styles
                        document.body.style.overflow = '';
                        document.body.style.paddingRight = '';
                        document.body.classList.remove('modal-open', 'offcanvas-open', 'overflow-hidden');
                    }
                }

                    , 350);
            }

        </script>
        <script>
            window.addEventListener('scroll', function () {
                const navbar = document.querySelector('.navbar');
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
        </script>
</body>

</html>