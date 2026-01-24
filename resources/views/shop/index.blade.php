@extends('layouts.app')

@section('title', 'Shop - ' . $title)

@section('content')
    <div class="container py-5">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shop</li>
                @if($aesthetic)
                    <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($aesthetic) }}</li>
                @endif
                @if($priceTier)
                    <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($priceTier) }}</li>
                @endif
            </ol>
        </nav>

        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold mb-2" style="font-family: 'Playfair Display', serif;">{{ $title }}</h1>
            <p class="text-muted">Curated excellence for your unique persona</p>
            <p class="small text-muted">{{ $products->total() }} items available</p>
        </div>

        <div class="row">
            <!-- Sidebar Filters -->
            <div class="col-lg-3 mb-4">
                <div class="bg-white p-4 rounded-4 shadow-sm">
                    <h5 class="mb-4">Discovery Filters</h5>

                    <div class="mb-4">
                        <label class="small fw-bold text-uppercase ls-1 mb-3 d-block">Aesthetic Universe</label>
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ request()->fullUrlWithQuery(['aesthetic' => null]) }}"
                                class="btn btn-sm {{ !$aesthetic ? 'btn-dark' : 'btn-outline-dark' }} rounded-pill text-start px-3">All
                                Aesthetics</a>
                            <a href="{{ request()->fullUrlWithQuery(['aesthetic' => 'soft']) }}"
                                class="btn btn-sm {{ $aesthetic == 'soft' ? 'btn-dark' : 'btn-outline-dark' }} rounded-pill text-start px-3">🌸
                                Soft Femme</a>
                            <a href="{{ request()->fullUrlWithQuery(['aesthetic' => 'alt']) }}"
                                class="btn btn-sm {{ $aesthetic == 'alt' ? 'btn-dark' : 'btn-outline-dark' }} rounded-pill text-start px-3">🖤
                                Alt Girly</a>
                            <a href="{{ request()->fullUrlWithQuery(['aesthetic' => 'luxury']) }}"
                                class="btn btn-sm {{ $aesthetic == 'luxury' ? 'btn-dark' : 'btn-outline-dark' }} rounded-pill text-start px-3">✨
                                Luxury Clean</a>
                            <a href="{{ request()->fullUrlWithQuery(['aesthetic' => 'mix']) }}"
                                class="btn btn-sm {{ $aesthetic == 'mix' ? 'btn-dark' : 'btn-outline-dark' }} rounded-pill text-start px-3">🎭
                                Modern Mix</a>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="small fw-bold text-uppercase ls-1 mb-3 d-block">Price Consciousness</label>
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ request()->fullUrlWithQuery(['price_tier' => 'accessible']) }}"
                                class="btn btn-sm {{ $priceTier == 'accessible' ? 'btn-dark' : 'btn-outline-dark' }} rounded-pill text-start px-3">Daily
                                Luxury</a>
                            <a href="{{ request()->fullUrlWithQuery(['price_tier' => 'aspirational']) }}"
                                class="btn btn-sm {{ $priceTier == 'aspirational' ? 'btn-dark' : 'btn-outline-dark' }} rounded-pill text-start px-3">Aspirational</a>
                            <a href="{{ request()->fullUrlWithQuery(['price_tier' => 'luxury']) }}"
                                class="btn btn-sm {{ $priceTier == 'luxury' ? 'btn-dark' : 'btn-outline-dark' }} rounded-pill text-start px-3">Investment</a>
                            @if($priceTier)
                                <a href="{{ request()->fullUrlWithQuery(['price_tier' => null]) }}"
                                    class="btn btn-link btn-sm text-muted text-decoration-none">Clear Price Filter</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <span class="text-muted small">Showing {{ $products->count() }} beautiful pieces</span>
                        @if($search)
                            <span class="text-muted small ms-2">for "{{ $search }}"</span>
                        @endif
                    </div>
                    <form action="{{ request()->fullUrlWithQuery([]) }}" method="GET" id="sortForm">
                        @foreach(request()->except(['sort', 'page']) as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <select name="sort" class="form-select form-select-sm border-0 bg-transparent fw-bold"
                            style="box-shadow: none; cursor: pointer;" onchange="this.form.submit()">
                            <option value="latest" {{ $sort == 'latest' ? 'selected' : '' }}>Sort by: Latest Arrivals</option>
                            <option value="price_asc" {{ $sort == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ $sort == 'price_desc' ? 'selected' : '' }}>Price: High to Low
                            </option>
                        </select>
                    </form>
                </div>

                <div class="row g-4">
                    @forelse ($products as $product)
                        <div class="col-6 col-md-4">
                            <x-product-card :product="$product" :badgeType="$product->aesthetic"
                                :badgeText="ucfirst($product->aesthetic)" />
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <h3 class="text-muted">No pieces found in this universe yet.</h3>
                            <a href="{{ url('/shop') }}" class="btn btn-dark mt-3 rounded-pill">View All Pieces</a>
                        </div>
                    @endforelse
                </div>

                @if($products->count() > 0)
                    <div class="mt-5">
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection