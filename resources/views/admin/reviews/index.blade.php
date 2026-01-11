@extends('layouts.admin')

@section('content')
    <h2 class="h3 mb-4 text-gray-800" style="font-family: 'Playfair Display', serif;">Review Moderation</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="list-group list-group-flush">
                <!-- Review Item 1 -->
                <div class="list-group-item p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="d-flex gap-3">
                            <img src="https://source.unsplash.com/random/100x100?face" class="rounded-circle" width="50"
                                height="50" alt="User">
                            <div>
                                <h6 class="mb-1 fw-bold">Sarah J. <span class="text-muted fw-normal small">on Rose Gold
                                        Abaya</span></h6>
                                <div class="mb-2 text-warning small">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                        class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                        class="fa-solid fa-star"></i>
                                </div>
                                <p class="mb-2 text-muted">"Absolutely loved the fabric! It feels so premium and the color
                                    is exactly like the pictures."</p>
                                <div class="d-flex gap-2">
                                    <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?ixlib=rb-4.0.3&w=100&q=80"
                                        class="rounded border" width="60" alt="Review Image">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <button class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i> Approve</button>
                            <button class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-xmark"></i> Reject</button>
                        </div>
                    </div>
                </div>

                <!-- Review Item 2 -->
                <div class="list-group-item p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="d-flex gap-3">
                            <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white"
                                style="width:50px; height:50px;">M</div>
                            <div>
                                <h6 class="mb-1 fw-bold">Mike T. <span class="text-muted fw-normal small">on Black
                                        Blazer</span></h6>
                                <div class="mb-2 text-warning small">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                        class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i><i
                                        class="fa-regular fa-star"></i>
                                </div>
                                <p class="mb-2 text-muted">"Size runs a bit small, but good quality otherwise."</p>
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <button class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i> Approve</button>
                            <button class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-xmark"></i> Reject</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection