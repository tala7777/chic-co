@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-4">
                <div class="card card-custom p-3">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-light rounded-circle p-2 me-2">
                            <i class="fa-regular fa-user"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">Sarah J.</h6>
                            <small class="text-muted">Soft Luxury Icon</small>
                        </div>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="#orders" class="list-group-item list-group-item-action border-0 active"
                            data-bs-toggle="list">My Orders</a>
                        <a href="#wishlist" class="list-group-item list-group-item-action border-0"
                            data-bs-toggle="list">Wishlist</a>
                        <a href="#profile" class="list-group-item list-group-item-action border-0"
                            data-bs-toggle="list">Style Profile</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="tab-content">
                    <!-- Orders Tab -->
                    <div class="tab-pane fade show active" id="orders">
                        <h4 class="mb-4">My Orders</h4>
                        <div class="card card-custom p-4 mb-3">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="fw-bold">Order #1023</span>
                                    <span class="text-muted small ms-2">Oct 25, 2023</span>
                                </div>
                                <span class="badge bg-success bg-opacity-10 text-success">Delivered</span>
                            </div>
                            <div class="d-flex gap-3 align-items-center mb-3">
                                <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?ixlib=rb-4.0.3&w=100&q=80"
                                    class="rounded" alt="Item">
                                <div>
                                    <h6 class="mb-1">Rose Gold Silk Abaya</h6>
                                    <small class="text-muted">Qty: 1</small>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold">149 JOD</span>
                                <button class="btn btn-sm btn-outline-dark">View Details</button>
                            </div>
                        </div>
                    </div>

                    <!-- Wishlist Tab -->
                    <div class="tab-pane fade" id="wishlist">
                        <h4 class="mb-4">Wishlist</h4>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="card card-custom h-100">
                                    <img src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?ixlib=rb-4.0.3&w=400&q=80"
                                        class="card-img-top" alt="Product">
                                    <div class="card-body">
                                        <h6 class="card-title">Studded Mini Bag</h6>
                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            <span class="fw-bold small">45 JOD</span>
                                            <button class="btn btn-sm btn-dark rounded-circle"><i
                                                    class="fa-solid fa-bag-shopping"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Style Profile Tab -->
                    <div class="tab-pane fade" id="profile">
                        <h4 class="mb-4">My Style Profile</h4>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="card card-custom p-4 h-100 bg-light">
                                    <h5>Your Vibe</h5>
                                    <div class="badge badge-soft fs-5 mb-3">Soft Girl 🌸</div>
                                    <p class="text-muted small">You love delicate fabrics, pastels, and feminine
                                        silhouettes.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-custom p-4 h-100 bg-light">
                                    <h5>Your Palette</h5>
                                    <div class="d-flex gap-2 mb-3">
                                        <span class="d-inline-block rounded-circle"
                                            style="width:30px; height:30px; background:#F6A6B2;"></span>
                                        <span class="d-inline-block rounded-circle"
                                            style="width:30px; height:30px; background:#FAF7F4; border:1px solid #ddd;"></span>
                                        <span class="d-inline-block rounded-circle"
                                            style="width:30px; height:30px; background:#C9A24D;"></span>
                                    </div>
                                    <p class="text-muted small">Pastels, Ivory, Gold Accents.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection