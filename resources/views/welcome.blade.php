@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="position-relative overflow-hidden d-flex align-items-center bg-soft-gradient"
        style="height: calc(100vh - 80px);">

        <!-- Animated Background Elements -->
        <div class="position-absolute top-0 end-0 p-5 mt-5 animate-fade-up d-none d-lg-block">
            <div class="rounded-circle"
                style="width: 500px; height: 500px; background: var(--color-primary-blush); opacity: 0.1; filter: blur(100px);">
            </div>
        </div>

        <div class="container position-relative z-1">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start">
                    <span class="badge bg-primary-subtle text-primary rounded-pill text-uppercase px-4 py-2 mb-4 animate-fade-up border-0 extra-small ls-2 fw-bold">
                        The Luxury Dashboard • Amman, Jordan
                    </span>
                    <h1 class="display-1 mb-4 animate-fade-up font-heading fw-bold" style="line-height: 1.05;">
                        Redefining<br>
                        Digital <span style="font-style: italic; color: var(--color-primary-blush);">Elegance</span>
                    </h1>
                    <p class="lead text-muted mb-5 animate-fade-up pe-lg-5 fs-4">
                        Experience Amman's first addictive luxury playground where every curation is matched to your aesthetic DNA.
                    </p>
                    <div class="d-flex flex-column flex-sm-row gap-4 justify-content-center justify-content-lg-start animate-fade-up">
                        <a href="{{ route('sparkle.quiz') }}" class="btn btn-premium btn-lg px-5 fs-5 py-4">
                            Calibrate Style ✨
                        </a>
                        <a href="{{ route('shop.index') }}" class="btn btn-premium-outline btn-lg px-5 fs-5 py-4">
                            View Collections
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 position-relative animate-fade-up">
                    <div class="position-relative ms-lg-5">
                        <!-- Main Image -->
                        <div class="rounded-5 overflow-hidden shadow-lg"
                             style="border: 12px solid white; transform: rotate(1deg);">
                            <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?q=80&w=800&auto=format&fit=crop"
                                alt="Luxury Fashion" class="img-fluid w-100">
                        </div>
                        <!-- Floating Detail Image -->
                        <div class="position-absolute bottom-0 start-0 d-none d-md-block shadow-lg rounded-5 overflow-hidden scale-hover transition-premium"
                            style="width: 240px; border: 8px solid white; transform: translate(-25%, 25%) rotate(-6deg);">
                            <img src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=400&auto=format&fit=crop"
                                alt="Detail" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="position-absolute bottom-0 start-50 translate-middle-x mb-5 d-none d-md-block opacity-25">
            <div class="d-flex flex-column align-items-center">
                <span class="extra-small text-uppercase mb-3 ls-2 fw-bold">Descent</span>
                <div class="bg-dark" style="width: 1px; height: 60px;"></div>
            </div>
        </div>
    </section>

    <!-- Aesthetic Selection -->
    <section class="container py-5 mt-lg-n5 position-relative z-2">
        <div class="card card-premium p-4 border shadow-sm">
            <div class="row g-4 align-items-center text-center">
                @foreach([
                    'soft' => ['label' => 'Soft Femme', 'emoji' => '🌸', 'sub' => 'Dabouq Elegance', 'bg' => 'rgba(246, 166, 178, 0.08)'],
                    'alt' => ['label' => 'Alt Girly', 'emoji' => '🖤', 'sub' => 'Abdoun Chic', 'bg' => 'rgba(30,30,30,0.05)'],
                    'luxury' => ['label' => 'Luxury Clean', 'emoji' => '✨', 'sub' => 'Al-Rabieh Minimalism', 'bg' => 'rgba(212, 175, 55, 0.05)'],
                    'mix' => ['label' => 'Modern Mix', 'emoji' => '🎭', 'sub' => 'Swafeih Cosmopolitan', 'bg' => 'rgba(23,162,184,0.05)']
                ] as $key => $data)
                <div class="col-lg-3 col-md-6">
                    <a href="{{ url('/shop?aesthetic='.$key) }}" class="text-decoration-none group d-block p-4 rounded-5 transition-premium" 
                       style="background: {{ $data['bg'] }};">
                        <h6 class="mb-1 text-dark font-heading fw-bold fs-5">{{ $data['label'] }} <span class="ms-1">{{ $data['emoji'] }}</span></h6>
                        <span class="text-muted extra-small text-uppercase ls-1 fw-bold">{{ $data['sub'] }}</span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured -->
    <section class="container py-5 mt-5">
        <div class="text-center mb-5">
            <span class="text-muted extra-small text-uppercase ls-2 fw-bold mb-3 d-block">The Selection</span>
            <h2 class="display-4 font-heading fw-bold">Curated For Amman</h2>
        </div>
        <livewire:featured-products />
    </section>

    <!-- Velvet Room -->
    <section class="container py-5 mb-5">
        <div class="card card-premium overflow-hidden position-relative shadow-lg border-0" style="height: 450px;">
            <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?q=80&w=1200&auto=format&fit=crop"
                alt="Boutique" class="w-100 h-100 object-fit-cover" style="filter: brightness(0.5) contrast(1.1);">
            <div class="position-absolute top-50 start-50 translate-middle text-center text-white w-75 animate-fade-up">
                <span class="extra-small text-uppercase ls-2 fw-bold mb-3 d-block opacity-75">Private Access</span>
                <h2 class="display-3 mb-4 font-heading fw-bold">The Velvet Room</h2>
                <p class="lead mb-5 opacity-75 fs-5">A digital sanctuary tailored to your aesthetic DNA.</p>
                <a href="#" onclick="handleEnterSession(event)" class="btn btn-light btn-lg px-5 py-4 rounded-pill fw-bold text-uppercase ls-1">
                    Enter Session <i class="fa-solid fa-arrow-right ms-2 fs-6"></i>
                </a>
            </div>
        </div>
    </section>

    <script>
        function handleEnterSession(e) {
            e.preventDefault();
            @auth
                window.location.href = "{{ route('enter.session') }}";
            @else
                Swal.fire({
                    title: 'The Velvet Room Awaits',
                    text: 'Authorized access is required to enter the tailored session.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sign In',
                    cancelButtonText: 'Join the List',
                    confirmButtonColor: '#1E1E1E',
                    cancelButtonColor: '#F6A6B2',
                    customClass: {
                        popup: 'rounded-5 p-4',
                        title: 'font-heading fw-bold'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('login', ['context' => 'quiz']) }}";
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire({
                            title: 'The Discovery Process',
                            text: 'We first need to understand your aesthetic DNA. You will be matched via our digital quiz.',
                            confirmButtonText: 'Start Quiz',
                            confirmButtonColor: '#1E1E1E',
                            customClass: { popup: 'rounded-5 p-4' }
                        }).then(() => {
                            window.location.href = "{{ route('sparkle.quiz') }}";
                        });
                    }
                });
            @endauth
        }
    </script>
@endsection