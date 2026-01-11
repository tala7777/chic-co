@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="position-relative overflow-hidden py-5"
        style="background: linear-gradient(180deg, rgba(246,166,178,0.1) 0%, rgba(250,247,244,1) 100%);">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="display-3 mb-4" style="line-height: 1.2;">Curated pieces for <br>
                        <span style="color: var(--color-primary-blush);">Soft Girls</span>,
                        <span class="text-dark">Alt Girls</span>, <br>
                        and <span class="text-gold">Ammani Energy</span>
                    </h1>
                    <p class="lead text-muted mb-4">Discover your unique style persona with our curated collections. From
                        rose gold dreams to edgy noir staples.</p>
                    <div class="d-flex gap-3">
                        <a href="{{ url('/quiz') }}" class="btn btn-primary-custom btn-lg">Find My Style</a>
                        <a href="{{ url('/shop') }}" class="btn btn-secondary-custom btn-lg">Browse Collection</a>
                    </div>
                </div>
                <div class="col-lg-6 position-relative">
                    <!-- Abstract Hero Image Composition -->
                    <div class="row g-2">
                        <div class="col-6">
                            <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                alt="Fashion Model" class="img-fluid rounded-4 shadow-sm"
                                style="transform: translateY(20px);">
                        </div>
                        <div class="col-6">
                            <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                alt="Fashion Detail" class="img-fluid rounded-4 shadow-sm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Style Picker (Quick Chips) -->
    <section class="container py-5">
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="#" class="btn btn-light rounded-pill px-4 py-2 border shadow-sm">Soft <span class="ms-1">🌸</span></a>
            <a href="#" class="btn btn-dark rounded-pill px-4 py-2 shadow-sm">Alt <span class="ms-1">🖤</span></a>
            <a href="#" class="btn btn-light rounded-pill px-4 py-2 border shadow-sm">Clean <span class="ms-1">🤍</span></a>
            <a href="#" class="btn rounded-pill px-4 py-2 border shadow-sm"
                style="background-color: #FFF3CD; color: #856404; border-color: #ffeeba !important;">Luxury <span
                    class="ms-1">✨</span></a>
        </div>
    </section>

    <!-- Featured Section -->
    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <h2 class="mb-0">Featured For You</h2>
            <a href="{{ url('/shop') }}" class="text-decoration-none text-gold fw-bold">View All <i
                    class="fa-solid fa-arrow-right ms-1"></i></a>
        </div>

        <div class="row g-4">
            <!-- Mock Product 1 -->
            <div class="col-6 col-md-3">
                <div class="card card-custom h-100 position-relative">
                    <span class="badge badge-luxury position-absolute top-0 start-0 m-3">Luxury</span>
                    <img src="https://images.unsplash.com/photo-1559192823-e1d8e87def53?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        class="card-img-top" alt="Dress">
                    <button class="btn btn-light rounded-circle shadow-sm position-absolute top-0 end-0 m-3"
                        style="width: 32px; height: 32px; padding: 0;"><i class="fa-regular fa-heart"></i></button>
                    <div class="card-body">
                        <h5 class="card-title h6">Rose Gold Abaya</h5>
                        <p class="card-text text-muted small">Soft • Evening</p>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="fw-bold">149 JOD</span>
                            <a href="{{ url('/shop/1') }}" class="btn btn-sm btn-outline-dark rounded-circle"><i
                                    class="fa-solid fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mock Product 2 -->
            <div class="col-6 col-md-3">
                <div class="card card-custom h-100 position-relative">
                    <span class="badge badge-alt position-absolute top-0 start-0 m-3">Alt</span>
                    <img src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        class="card-img-top" alt="Jacket">
                    <button class="btn btn-light rounded-circle shadow-sm position-absolute top-0 end-0 m-3"
                        style="width: 32px; height: 32px; padding: 0;"><i class="fa-regular fa-heart"></i></button>
                    <div class="card-body">
                        <h5 class="card-title h6">Edgy Black Blazer</h5>
                        <p class="card-text text-muted small">Alt • Chic</p>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="fw-bold">89 JOD</span>
                            <a href="#" class="btn btn-sm btn-outline-dark rounded-circle"><i
                                    class="fa-solid fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mock Product 3 -->
            <div class="col-6 col-md-3">
                <div class="card card-custom h-100 position-relative">
                    <span class="badge badge-soft position-absolute top-0 start-0 m-3">Soft</span>
                    <img src="https://images.unsplash.com/photo-1612336307429-8a898d10e223?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        class="card-img-top" alt="Dress">
                    <button class="btn btn-light rounded-circle shadow-sm position-absolute top-0 end-0 m-3"
                        style="width: 32px; height: 32px; padding: 0;"><i class="fa-regular fa-heart"></i></button>
                    <div class="card-body">
                        <h5 class="card-title h6">Blush Satin Dress</h5>
                        <p class="card-text text-muted small">Soft • Elegant</p>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="fw-bold">120 JOD</span>
                            <a href="#" class="btn btn-sm btn-outline-dark rounded-circle"><i
                                    class="fa-solid fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mock Product 4 -->
            <div class="col-6 col-md-3">
                <div class="card card-custom h-100 position-relative">
                    <span class="badge badge-luxury position-absolute top-0 start-0 m-3">Classic</span>
                    <img src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        class="card-img-top" alt="Bag">
                    <button class="btn btn-light rounded-circle shadow-sm position-absolute top-0 end-0 m-3"
                        style="width: 32px; height: 32px; padding: 0;"><i class="fa-regular fa-heart"></i></button>
                    <div class="card-body">
                        <h5 class="card-title h6">Studded Mini Bag</h5>
                        <p class="card-text text-muted small">Luxury • Access...</p>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="fw-bold">45 JOD</span>
                            <a href="#" class="btn btn-sm btn-outline-dark rounded-circle"><i
                                    class="fa-solid fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Limited Drop Banner -->
    <section class="container py-4">
        <div class="rounded-4 p-5 text-white position-relative overflow-hidden"
            style="background-color: var(--color-ink-black);">
            <div class="position-absolute top-0 start-0 w-100 h-100"
                style="background: url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80') center/cover; opacity: 0.4;">
            </div>
            <div class="position-relative z-1 text-center">
                <h2 class="display-5" style="font-family: 'Playfair Display', serif;">Limited Drop: Golden Hour</h2>
                <p class="lead mb-4">Only 2 days left to grab the exclusive evening collection.</p>
                <a href="{{ url('/shop') }}" class="btn btn-primary-custom px-5">Shop Now</a>
            </div>
        </div>
    </section>
@endsection