@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 text-gray-800" style="font-family: 'Playfair Display', serif;">Products</h2>
        <a href="{{ url('/admin/products/create') }}" class="btn btn-primary-custom btn-sm"><i
                class="fa-solid fa-plus me-2"></i>Add Product</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th width="50">Img</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?ixlib=rb-4.0.3&w=100&q=80"
                                    class="rounded" width="40" alt=""></td>
                            <td class="fw-bold">Rose Gold Silk Abaya</td>
                            <td>Clothing</td>
                            <td>149 JOD</td>
                            <td><span class="badge bg-success bg-opacity-10 text-success">In Stock (12)</span></td>
                            <td>
                                <button class="btn btn-sm btn-link text-dark"><i class="fa-solid fa-pen"></i></button>
                                <button class="btn btn-sm btn-link text-danger"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?ixlib=rb-4.0.3&w=100&q=80"
                                    class="rounded" width="40" alt=""></td>
                            <td class="fw-bold">Studded Mini Bag</td>
                            <td>Accessories</td>
                            <td>45 JOD</td>
                            <td><span class="badge bg-warning bg-opacity-10 text-dark">Low Stock (2)</span></td>
                            <td>
                                <button class="btn btn-sm btn-link text-dark"><i class="fa-solid fa-pen"></i></button>
                                <button class="btn btn-sm btn-link text-danger"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection