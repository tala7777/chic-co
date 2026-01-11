@extends('layouts.app')

@section('title', 'Product Detail')

@section('content')
    <div class="container py-5">
        <div class="row g-5">
            <!-- Gallery -->
            <div class="col-md-6">
                <div class="row g-2">
                    <div class="col-12">
                        <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            class="img-fluid rounded-4 w-100" alt="Main Image">
                    </div>
                    <div class="col-3">
                        <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80"
                            class="img-fluid rounded-3" alt="Thumb">
                    </div>
                    <div class="col-3">
                        <img src="https://source.unsplash.com/random/200x200?fashion,detail" class="img-fluid rounded-3"
                            alt="Thumb">
                    </div>
                </div>
            </div>

            <!-- Details -->
            <div class="col-md-6">
                <span class="badge badge-soft mb-2">Soft Girl</span>
                <h1 class="display-5 mb-2" style="font-family: 'Playfair Display', serif;">Rose Gold Silk Abaya</h1>
                <div class="mb-4">
                    <span class="h3 me-2">149 JOD</span>
                    <span class="text-muted text-decoration-line-through">180 JOD</span>
                </div>

                <p class="text-muted mb-4">
                    Crafted from premium silk, this piece embodies the "Soft Girl" aesthetic with its delicate pink hue and
                    flowing silhouette. Perfect for evening events or upscale gatherings.
                </p>

                <div class="mb-4">
                    <label class="form-label fw-bold">Size</label>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-dark px-3 active">S</button>
                        <button class="btn btn-outline-dark px-3">M</button>
                        <button class="btn btn-outline-dark px-3">L</button>
                    </div>
                </div>

                <div class="d-flex gap-3 mb-5">
                    <a href="{{ url('/cart') }}" class="btn btn-primary-custom flex-grow-1">Add to Bag</a>
                    <button class="btn btn-outline-dark rounded-circle" style="width: 48px; height: 48px;"><i
                            class="fa-regular fa-heart"></i></button>
                </div>

                <hr>

                <div class="accordion accordion-flush" id="productDetails">
                    <div class="accordion-item bg-transparent">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent" type="button"
                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne">
                                Styled With
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse">
                            <div class="accordion-body">Matches perfectly with our Pearl Clutch and Nude Heels.</div>
                        </div>
                    </div>
                    <div class="accordion-item bg-transparent">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent" type="button"
                                data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo">
                                Shipping & Returns
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse">
                            <div class="accordion-body">Free shipping on orders over 100 JOD.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection