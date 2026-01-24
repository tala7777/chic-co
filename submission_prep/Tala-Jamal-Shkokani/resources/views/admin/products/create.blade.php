@extends('layouts.admin')

@section('content')
    <div class="mb-4">
        <h2>Add New Product</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
                <li class="breadcrumb-item active">Add Product</li>
            </ol>
        </nav>
    </div>

    <div class="card border-0 shadow-sm" style="max-width: 600px;">
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" method="POST">
                @csrf

                <x-input name="name" label="Product Name" placeholder="Enter product name" />

                <x-input name="price" type="number" step="0.01" label="Price (JOD)" placeholder="0.00" />

                <div class="mb-3">
                    <label for="category_id" class="form-label small fw-bold text-uppercase"
                        style="letter-spacing: 0.5px; color: var(--color-soft-gray);">Category</label>
                    <select name="category_id" id="category_id"
                        class="form-select border-0 shadow-sm px-3 py-2 @error('category_id') is-invalid @enderror"
                        style="background: rgba(0,0,0,0.02); border-radius: 10px;">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4">
                    <x-button type="submit" class="px-5">Create Product</x-button>
                    <x-button :href="route('admin.products.index')" variant="outline-secondary"
                        class="px-5 ms-2">Cancel</x-button>
                </div>
            </form>
        </div>
    </div>
@endsection