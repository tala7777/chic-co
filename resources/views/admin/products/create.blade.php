@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 text-gray-800" style="font-family: 'Playfair Display', serif;">Add New Product</h2>
        <a href="{{ url('/admin/products') }}" class="btn btn-outline-secondary btn-sm">Cancel</a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 fw-bold text-dark">Product Details</h6>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control" placeholder="e.g., Rose Gold Silk Abaya">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="4"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Price (JOD)</label>
                                <input type="number" class="form-control" placeholder="0.00">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Stock Quantity</label>
                                <input type="number" class="form-control" placeholder="0">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 fw-bold text-dark">Media</h6>
                </div>
                <div class="card-body">
                    <div class="border-2 border-dashed border-secondary rounded p-5 text-center bg-light"
                        style="border-style: dashed !important;">
                        <i class="fa-solid fa-cloud-arrow-up fa-2x text-muted mb-3"></i>
                        <p class="mb-0 text-muted">Drag and drop images here, or click to upload</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 fw-bold text-dark">Organization</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-select">
                            <option>Clothing</option>
                            <option>Accessories</option>
                            <option>Shoes</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Style Persona</label>
                        <div class="d-flex flex-wrap gap-2">
                            <input type="checkbox" class="btn-check" id="tag-soft">
                            <label class="btn btn-outline-dark btn-sm rounded-pill" for="tag-soft">Soft Girl 🌸</label>

                            <input type="checkbox" class="btn-check" id="tag-alt">
                            <label class="btn btn-outline-dark btn-sm rounded-pill" for="tag-alt">Alt Girl 🖤</label>

                            <input type="checkbox" class="btn-check" id="tag-clean">
                            <label class="btn btn-outline-dark btn-sm rounded-pill" for="tag-clean">Clean Girl 🤍</label>

                            <input type="checkbox" class="btn-check" id="tag-lux">
                            <label class="btn btn-outline-dark btn-sm rounded-pill" for="tag-lux">Luxury ✨</label>
                        </div>
                    </div>

                    <hr>

                    <button class="btn btn-primary-custom w-100">Publish Product</button>
                </div>
            </div>
        </div>
    </div>
@endsection