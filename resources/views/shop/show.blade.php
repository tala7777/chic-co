@extends('layouts.app')

@section('title', $product->name . ' - Chic & Co.')

@section('content')
    @php 
        $allImages = $product->images->count() > 0 ? $product->images : collect([ (object)['url' => $product->image] ]);
    @endphp
    <div class="container py-5"
        x-data="{ mainImage: '{{ $product->image ?? ($product->images->where('is_primary', true)->first()->url ?? 'https://via.placeholder.com/800x1000') }}' }">
        <div class="row g-5">
            <!-- Gallery -->
            <div class="col-md-7">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="position-relative overflow-hidden rounded-4 shadow-sm bg-light d-flex align-items-center justify-content-center" style="height: 65vh; max-height: 600px;">
                            <img :src="mainImage" class="w-100 h-100 object-fit-contain"
                                x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100" :key="mainImage" alt="{{ $product->name }}">

                            <!-- Internal Navigation -->
                            @if($allImages->count() > 1)
                                <div
                                    class="position-absolute top-50 start-0 translate-middle-y ps-3 opacity-0 hover-visible transition-all">
                                    <button class="btn btn-white btn-sm rounded-circle shadow-sm"
                                        style="width: 32px; height: 32px;"
                                        @click="let idx = {{ json_encode($allImages->pluck('url')) }}.indexOf(mainImage); mainImage = {{ json_encode($allImages->pluck('url')) }}[(idx - 1 + {{ $allImages->count() }}) % {{ $allImages->count() }}]">
                                        <i class="fa-solid fa-chevron-left extra-small"></i>
                                    </button>
                                </div>
                                <div
                                    class="position-absolute top-50 end-0 translate-middle-y pe-3 opacity-0 hover-visible transition-all">
                                    <button class="btn btn-white btn-sm rounded-circle shadow-sm"
                                        style="width: 32px; height: 32px;"
                                        @click="let idx = {{ json_encode($allImages->pluck('url')) }}.indexOf(mainImage); mainImage = {{ json_encode($allImages->pluck('url')) }}[(idx + 1) % {{ $allImages->count() }}]">
                                        <i class="fa-solid fa-chevron-right extra-small"></i>
                                    </button>
                                </div>
                            @endif
                            <div class="position-absolute top-0 start-0 p-4">
                                <span
                                    class="badge aesthetic-{{ $product->aesthetic }} text-uppercase ls-1 px-3 py-2 shadow-sm">
                                    {{ ucfirst($product->aesthetic) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex gap-3 overflow-auto pb-3 custom-scrollbar">
                            @foreach($allImages as $img)
                                <div class="flex-shrink-0" style="width: 65px; height: 85px;">
                                    <img src="{{ $img->url }}"
                                        class="w-100 h-100 object-fit-cover rounded-3 cursor-pointer transition-all border"
                                        :style="mainImage === '{{ $img->url }}' ? 'border-color: #000 !important; opacity: 1;' : 'border-color: transparent; opacity: 0.6;'"
                                        @click="mainImage = '{{ $img->url }}'" alt="Product view">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Details -->
            <div class="col-md-5" x-data="{ selectedSize: 'M', selectedColor: '{{ $product->colors[0] ?? '' }}' }">
                <div class="ps-md-4">
                    <nav aria-label="breadcrumb" class="mb-3">
                        <ol class="breadcrumb small text-uppercase ls-1">
                            <li class="breadcrumb-item"><a href="{{ route('shop.index') }}"
                                    class="text-decoration-none text-muted">Shop</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('shop.index', ['aesthetic' => $product->aesthetic]) }}"
                                    class="text-decoration-none text-muted">{{ $product->aesthetic }}</a></li>
                        </ol>
                    </nav>

                    <h1 class="display-5 mb-3 fw-bold" style="font-family: 'Playfair Display', serif;">{{ $product->name }}
                    </h1>

                    <div class="d-flex align-items-center mb-4">
                        <span class="h2 mb-0 fw-bold">{{ number_format($product->price, 0) }} JOD</span>
                        @if($product->stock < 10 && $product->stock > 0)
                            <span class="badge bg-warning-subtle text-warning ms-3 rounded-pill px-3">Only {{ $product->stock }}
                                left</span>
                        @elseif($product->stock === 0)
                            <span class="badge bg-danger-subtle text-danger ms-3 rounded-pill px-3">Out of Stock</span>
                        @endif
                    </div>

                    <!-- Colors -->
                    @if($product->colors && count($product->colors) > 0)
                        <div class="mb-4">
                            <label class="small fw-bold text-uppercase ls-1 mb-3 d-block">Select Color</label>
                            <div class="d-flex gap-2">
                                @foreach($product->colors as $color)
                                    <button @click="selectedColor = '{{ $color }}'" class="color-btn"
                                        :class="selectedColor === '{{ $color }}' ? 'active' : ''"
                                        style="background-color: {{ $color }};" title="{{ $color }}">
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Sizes -->
                    <div class="mb-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="small fw-bold text-uppercase ls-1">Select Size</label>
                            <a href="#" class="small text-muted text-decoration-underline">Size Guide</a>
                        </div>
                        <div class="d-flex gap-3">
                            @foreach(['XS', 'S', 'M', 'L', 'XL'] as $size)
                                <button @click="selectedSize = '{{ $size }}'" class="size-btn"
                                    :class="selectedSize === '{{ $size }}' ? 'active' : ''">
                                    {{ $size }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex gap-3 mb-5">
                        <div class="flex-grow-1">
                            <livewire:add-to-cart-button :productId="$product->id" :key="'add-cart-show-' . $product->id"
                                class="w-100 py-3" />
                        </div>
                        <livewire:wishlist-button :productId="$product->id"
                            class="btn btn-outline-dark rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 56px; height: 56px; transition: all 0.3s ease; border: 1px solid #dee2e6;" />
                    </div>

                    <p class="text-muted mb-4 fs-5 leading-relaxed">
                        {{ $product->description }}
                    </p>

                    <!-- Info Tabs -->
                    <!-- Info Tabs (Alpine.js Version) -->
                    <div class="border-top mb-4" x-data="{ expanded: null }">
                        <!-- Details & Care -->
                        <div class="border-bottom">
                            <button @click="expanded = expanded === 'details' ? null : 'details'" 
                                    class="w-100 py-3 bg-transparent border-0 d-flex justify-content-between align-items-center text-uppercase fw-bold small ls-1 text-dark"
                                    style="outline: none;">
                                Details & Care
                                <i class="fa-solid fa-chevron-down transition-transform" 
                                   :style="expanded === 'details' ? 'transform: rotate(180deg)' : ''"></i>
                            </button>
                            <div x-show="expanded === 'details'" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 -translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 style="display: none;">
                                <div class="pb-3 text-muted small leading-relaxed">
                                    <p class="mb-2"><b>Composition:</b> 100% Curated Luxury Materials. Hand-finished in our Amman atelier.</p>
                                    <p class="mb-2"><b>Fit:</b> Designed for a contemporary silhouettes. Fits true to size.</p>
                                    <p class="mb-0"><b>Care:</b> Dry clean only to maintain the aesthetic integrity and fabric longevity.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping & Returns -->
                        <div class="border-bottom">
                            <button @click="expanded = expanded === 'shipping' ? null : 'shipping'" 
                                    class="w-100 py-3 bg-transparent border-0 d-flex justify-content-between align-items-center text-uppercase fw-bold small ls-1 text-dark"
                                    style="outline: none;">
                                Shipping & Returns
                                <i class="fa-solid fa-chevron-down transition-transform" 
                                   :style="expanded === 'shipping' ? 'transform: rotate(180deg)' : ''"></i>
                            </button>
                            <div x-show="expanded === 'shipping'" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 -translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 style="display: none;">
                                <div class="pb-3 text-muted small leading-relaxed">
                                    <p class="mb-2"><b>Complimentary Shipping:</b> Free express delivery within Amman (1-2 business days).</p>
                                    <p class="mb-0"><b>Signature Returns:</b> We offer a 14-day curation guarantee. Returns are accepted in original condition.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <style>
                        .transition-transform { transition: transform 0.3s ease; }
                    </style>
                </div>
            </div>
        </div>

        <!-- Customer Feedback -->
        <livewire:product-reviews :productId="$product->id" />

        <!-- Recommendations -->
        @if($recommendations->count() > 0)
            <div class="mt-5 pt-5 border-top">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <div>
                        <span class="text-muted small text-uppercase ls-1">Complete your universe</span>
                        <h2 class="display-6 mb-0" style="font-family: 'Playfair Display', serif;">You Might Also Like</h2>
                    </div>
                    <a href="{{ route('shop.index') }}" class="text-dark text-decoration-underline small">View All</a>
                </div>
                <div class="row g-4 text-start">
                    @foreach($recommendations as $rec)
                        <div class="col-6 col-md-3">
                            <x-product-card :product="$rec" :badgeType="$rec->aesthetic" :badgeText="ucfirst($rec->aesthetic)" />
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Post-Purchase Suggestions -->
        <livewire:add-to-cart-suggestions />
    </div>

    <style>
        .size-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 1px solid #dee2e6;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .size-btn:hover {
            border-color: #000;
        }

        .size-btn.active {
            background: #000;
            color: #fff;
            border-color: #000;
        }

        .color-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 0 0 1px #eee;
            transition: all 0.2s ease;
            position: relative;
        }

        .color-btn:hover {
            transform: scale(1.1);
        }

        .color-btn.active {
            box-shadow: 0 0 0 2px #000;
        }

        .leading-relaxed {
            line-height: 1.7;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .border-transparent {
            border-color: transparent;
        }

        .hover-opacity-100:hover {
            opacity: 1 !important;
        }

        .custom-scrollbar::-webkit-scrollbar {
            height: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #eee;
            border-radius: 10px;
        }

        .position-relative:hover .hover-visible {
            opacity: 1 !important;
        }

        .btn-white {
            background: #fff;
            color: #000;
            border: none;
        }

        .btn-white:hover {
            background: #000;
            color: #fff;
        }
    </style>
@endsection