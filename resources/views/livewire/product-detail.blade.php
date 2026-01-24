<div class="container py-5 animate-fade-up"
    x-data="{ mainImage: '{{ $product->image ?? ($product->images->where('is_primary', true)->first()->url ?? 'https://via.placeholder.com/800x1000') }}' }">
    @php 
        $allImages = $product->images->count() > 0 ? $product->images : collect([ (object)['url' => $product->image] ]);
    @endphp
    
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb" class="mb-5 px-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('shop.index') }}" class="text-decoration-none text-muted extra-small text-uppercase ls-1">The Collection</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop.index', ['aesthetic' => $product->aesthetic]) }}" class="text-decoration-none text-muted extra-small text-uppercase ls-1">{{ $product->aesthetic }}</a></li>
            <li class="breadcrumb-item active extra-small text-uppercase ls-1" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row g-5">
        <!-- Gallery -->
        <div class="col-md-7">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card card-premium overflow-hidden bg-light d-flex align-items-center justify-content-center shadow-none border-0" style="height: 70vh; max-height: 700px;">
                        <img :src="mainImage" class="w-100 h-100 object-fit-contain p-4"
                            x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100" :key="mainImage" alt="{{ $product->name }}">

                        <!-- Internal Navigation -->
                        @if($allImages->count() > 1)
                            <div class="position-absolute top-50 start-0 translate-middle-y ps-4 opacity-0 hover-visible transition-premium">
                                <button class="btn btn-white btn-lg rounded-circle shadow-sm"
                                    style="width: 50px; height: 50px;"
                                    @click="let idx = {{ json_encode($allImages->pluck('url')) }}.indexOf(mainImage); mainImage = {{ json_encode($allImages->pluck('url')) }}[(idx - 1 + {{ $allImages->count() }}) % {{ $allImages->count() }}]">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </button>
                            </div>
                            <div class="position-absolute top-50 end-0 translate-middle-y pe-4 opacity-0 hover-visible transition-premium">
                                <button class="btn btn-white btn-lg rounded-circle shadow-sm"
                                    style="width: 50px; height: 50px;"
                                    @click="let idx = {{ json_encode($allImages->pluck('url')) }}.indexOf(mainImage); mainImage = {{ json_encode($allImages->pluck('url')) }}[(idx + 1) % {{ $allImages->count() }}]">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </button>
                            </div>
                        @endif
                        
                        <div class="position-absolute top-0 start-0 p-4">
                            <span class="badge bg-primary-subtle text-primary text-uppercase ls-1 px-4 py-2 border-0 rounded-pill font-heading">
                                {{ strtoupper($product->aesthetic) }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-12 px-3">
                    <div class="d-flex gap-3 overflow-auto pb-3 custom-scrollbar">
                        @foreach($allImages as $img)
                            <div class="flex-shrink-0 card card-premium p-0 border overflow-hidden transition-premium" 
                                 style="width: 80px; height: 100px; cursor: pointer;"
                                 :style="mainImage === '{{ $img->url }}' ? 'border-color: var(--color-primary-blush) !important; transform: scale(1.05);' : 'opacity: 0.6;'"
                                 @click="mainImage = '{{ $img->url }}'">
                                <img src="{{ $img->url }}" class="w-100 h-100 object-fit-cover" alt="Perspective view">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Details -->
        <div class="col-md-5" x-data="{ selectedSize: 'M', selectedColor: '{{ $product->colors[0] ?? '' }}' }">
            <div class="ps-md-4">
                <h1 class="display-4 mb-4 font-heading fw-bold">{{ $product->name }}</h1>

                <div class="d-flex align-items-center mb-5 mt-2">
                    <span class="h1 mb-0 fw-bold text-dark font-heading">{{ number_format($product->price, 0) }} JOD</span>
                    @if($product->stock < 10 && $product->stock > 0)
                        <span class="badge bg-warning-subtle text-warning ms-4 rounded-pill px-4 py-2 text-uppercase extra-small ls-1 fw-bold">Only {{ $product->stock }} Left</span>
                    @elseif($product->stock === 0)
                        <span class="badge bg-danger-subtle text-danger ms-4 rounded-pill px-4 py-2 text-uppercase extra-small ls-1 fw-bold">Out of Stock</span>
                    @endif
                </div>

                <!-- Colors -->
                @if($product->colors && count($product->colors) > 0)
                    <div class="mb-5">
                        <label class="extra-small text-muted text-uppercase fw-bold ls-2 mb-4 d-block">The Palette</label>
                        <div class="d-flex gap-3">
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
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <label class="extra-small text-muted text-uppercase fw-bold ls-2">Scale Selection</label>
                        <a href="#" class="extra-small text-muted text-decoration-none border-bottom border-muted text-uppercase ls-1">View Guide</a>
                    </div>
                    <div class="d-flex gap-3">
                        @foreach($product->sizes ?? ['XS', 'S', 'M', 'L', 'XL'] as $size)
                            <button @click="selectedSize = '{{ $size }}'" class="size-btn"
                                :class="selectedSize === '{{ $size }}' ? 'active' : ''">
                                {{ $size }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Actions -->
                <div class="d-flex gap-4 mb-5 pt-3">
                    <div class="flex-grow-1">
                        <livewire:add-to-cart-button :productId="$product->id" :key="'add-cart-show-' . $product->id"
                            class="w-100 py-4 btn-premium btn-lg fs-5" />
                    </div>
                    <livewire:wishlist-button :productId="$product->id"
                        class="btn btn-premium-outline rounded-circle shadow-none d-flex align-items-center justify-content-center"
                        style="width: 65px; height: 65px;" />
                </div>

                <div class="p-4 rounded-5 bg-white border mb-5 leading-relaxed">
                    <p class="text-muted mb-0 small">
                        {{ $product->description }}
                    </p>
                </div>

                <!-- Info Accordion -->
                <div class="accordion accordion-flush" id="productSpecs" x-data="{ expanded: null }">
                    <div class="card card-premium overflow-hidden shadow-none border mb-3">
                        <button class="btn btn-link w-100 text-start p-4 text-decoration-none d-flex justify-content-between align-items-center text-uppercase extra-small ls-1 fw-bold text-dark"
                                @click="expanded = (expanded === 'details' ? null : 'details')">
                            Details & Craftsmanship
                            <i class="fa-solid" :class="expanded === 'details' ? 'fa-minus' : 'fa-plus'"></i>
                        </button>
                        <div x-show="expanded === 'details'" class="p-4 pt-0 text-muted small animate-fade-up">
                            <p class="mb-3">Our pieces are curated with an insistence on high-end materiality and silhouette integrity.</p>
                            <ul class="ps-3 mb-0">
                                <li>100% Luxury Fiber Composition</li>
                                <li>Heritage Finished Hemlines</li>
                                <li>Global Aesthetic Compliance</li>
                            </ul>
                        </div>
                    </div>

                    <div class="card card-premium overflow-hidden shadow-none border mb-3">
                        <button class="btn btn-link w-100 text-start p-4 text-decoration-none d-flex justify-content-between align-items-center text-uppercase extra-small ls-1 fw-bold text-dark"
                                @click="expanded = (expanded === 'shipping' ? null : 'shipping')">
                            The Arrival Experience
                            <i class="fa-solid" :class="expanded === 'shipping' ? 'fa-minus' : 'fa-plus'"></i>
                        </button>
                        <div x-show="expanded === 'shipping'" class="p-4 pt-0 text-muted small animate-fade-up">
                            <p class="mb-0">Complementary white-glove arrival within 24-48 hours. Secure archival packaging included.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Feedback -->
    <div class="mt-5 pt-5">
        <livewire:product-reviews :productId="$product->id" />
    </div>

    <!-- Recommendations -->
    @if($recommendations->count() > 0)
        <div class="mt-5 pt-5 border-top">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <span class="text-muted extra-small text-uppercase ls-1">Complete your universe</span>
                    <h2 class="display-5 mb-0 font-heading fw-bold">You Might Also Like</h2>
                </div>
                <a href="{{ route('shop.index') }}" class="btn btn-premium-outline btn-sm py-2 px-4 shadow-none">View Archive</a>
            </div>
            <div class="row g-4 text-start">
                @foreach($recommendations as $rec)
                    <div class="col-6 col-md-3">
                        <x-product-card :product="$rec" :badgeType="$rec->aesthetic" :badgeText="strtoupper($rec->aesthetic)" />
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <livewire:add-to-cart-suggestions />

    <style>
        .size-btn {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            border: 1px solid #eee;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            font-weight: 600;
            transition: var(--transition-premium);
        }
        .size-btn:hover { border-color: var(--color-ink-black); transform: scale(1.05); }
        .size-btn.active { background: var(--color-ink-black); color: #fff; border-color: var(--color-ink-black); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }

        .color-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 3px solid #fff;
            box-shadow: 0 0 0 1px #eee;
            transition: var(--transition-premium);
        }
        .color-btn:hover { transform: scale(1.15); }
        .color-btn.active { box-shadow: 0 0 0 2px var(--color-ink-black); }

        .leading-relaxed { line-height: 1.8; }
        .custom-scrollbar::-webkit-scrollbar { height: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #eee; border-radius: 10px; }
        .card-premium:hover .hover-visible { opacity: 1 !important; }
        
        .btn-white { background: #fff; color: #000; border: none; }
        .btn-white:hover { background: #000; color: #fff; }
    </style>
</div>
