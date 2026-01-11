@extends('layouts.app')

@section('title', 'Shop')

@section('content')
    <div class="container py-5">
        <div class="row">
            <!-- Sidebar Filters -->
            <div class="col-lg-3 mb-4">
                <div class="bg-white p-4 rounded-4 shadow-sm">
                    <h5 class="mb-4">Filters</h5>

                    <div class="mb-4">
                        <h6 class="fw-bold mb-2">Categories</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="cat1">
                            <label class="form-check-label" for="cat1">Clothing</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="cat2">
                            <label class="form-check-label" for="cat2">Accessories</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold mb-2">Style Tag</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge badge-soft cursor-pointer">Soft</span>
                            <span class="badge badge-alt cursor-pointer">Alt</span>
                            <span class="badge badge-luxury cursor-pointer">Luxury</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold mb-2">Price Range</h6>
                        <input type="range" class="form-range" min="0" max="500">
                        <div class="d-flex justify-content-between small text-muted">
                            <span>0 JOD</span>
                            <span>500 JOD</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="text-muted">Showing 9 of 24 products</span>
                    <select class="form-select w-auto border-0 bg-transparent fw-bold" style="box-shadow: none;">
                        <option>Sort by: Recommended</option>
                        <option>Price: Low to High</option>
                        <option>Newest</option>
                    </select>
                </div>

                <div class="row g-4">
                    <!-- Repeat Product Card x6 -->
                    @for ($i = 1; $i <= 6; $i++)
                        <div class="col-6 col-md-4">
                            <div class="card card-custom h-100">
                                <div class="position-relative">
                                    <img src="https://source.unsplash.com/random/400x500?fashion,{{ $i }}" class="card-img-top"
                                        alt="Product">
                                    <button class="btn btn-light rounded-circle shadow-sm position-absolute top-0 end-0 m-3"
                                        style="width: 32px; height: 32px; padding: 0;"><i
                                            class="fa-regular fa-heart"></i></button>
                                </div>
                                <div class="card-body">
                                    <h5 class="h6">Elegant Piece {{ $i }}</h5>
                                    <p class="small text-muted mb-2">Soft • Evening</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">{{ rand(30, 150) }} JOD</span>
                                        <button @click="addToCart('Elegant Piece {{ $i }}')"
                                            class="btn btn-sm btn-outline-dark rounded-circle"><i
                                                class="fa-solid fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>

                <div class="text-center mt-5">
                    <button class="btn btn-outline-dark rounded-pill px-5">Load More</button>
                </div>
            </div>
        </div>
    </div>
@endsection