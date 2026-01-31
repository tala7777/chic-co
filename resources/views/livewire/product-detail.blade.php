<div class="container py-4 py-md-5 animate-fade-up" 
     x-data="{ mainImage: '{{ $product->image ?? ($product->images->count() > 0 ? $product->images->first()->url : 'https://via.placeholder.com/800x1200') }}' }">
    
    @php 
        // Ensure we handle both model instances and plain objects consistently
        $mainUrl = $product->image ?? ($product->images->first()?->url ?? 'https://via.placeholder.com/800x1200');
        
        $galleryImages = $product->images->map(fn($img) => (object)['url' => $img->url]);
        $primaryImg = (object)['url' => $mainUrl];
        
        $allImages = collect([$primaryImg])
            ->concat($galleryImages)
            ->unique('url')
            ->values();
        
        $sizeOrderMap = [
            'XXS' => 1, 'XS' => 2, 'S' => 3, 'M' => 4, 
            'L' => 5, 'XL' => 6, 'XXL' => 7, 'XXXL' => 8
        ];
        
        $availableSizes = ($product->sizes && count($product->sizes) > 0) ? $product->sizes : ['XS', 'S', 'M', 'L', 'XL'];
        
        usort($availableSizes, function($a, $b) use ($sizeOrderMap) {
            $rankA = $sizeOrderMap[strtoupper($a)] ?? 99;
            $rankB = $sizeOrderMap[strtoupper($b)] ?? 99;
            return $rankA <=> $rankB;
        });

        $availableColors = $product->colors ?? [];
    @endphp

    <style>
        .gallery-main-container { 
            width: 100%;
            aspect-ratio: 4/5; /* Standardized ratio */
            background-color: #f8f8f8;
            border: 1px solid rgba(0,0,0,0.02);
            overflow: hidden;
        }
        @media (max-width: 768px) {
            .gallery-main-container { aspect-ratio: 1/1; }
        }
        .main-display-img { 
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1); 
        }
        .gallery-main-container:hover .main-display-img { transform: scale(1.05); }
        
        .thumbnail-scroll-container {
            max-height: 550px; /* Reduced to match global scale */
            overflow-y: auto;
            scrollbar-width: none;
        }
        .thumbnail-scroll-container::-webkit-scrollbar { display: none; }

        .transition-premium { transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1); }
        
        .size-option-btn {
            min-width: 48px; height: 48px; border-radius: 50%; border: 1px solid #EDEDED;
            background: #fff; font-size: 0.75rem; font-weight: 800; transition: all 0.3s ease; color: #444;
            display: flex; align-items: center; justify-content: center;
        }
        .size-option-btn:hover:not(:disabled) { background-color: rgba(0, 0, 0, 0.05); transform: translateY(-2px); }
        .size-option-btn.active { background: #1a1a1a; color: #fff; border-color: #1a1a1a; box-shadow: 0 8px 20px rgba(0,0,0,0.15); }
        .size-option-btn:disabled { opacity: 0.3; cursor: not-allowed; text-decoration: line-through; }

        .color-option-btn { 
            width: 32px; height: 32px; border-radius: 50%; border: 3px solid #fff; 
            box-shadow: 0 0 0 1px #eee; transition: all 0.3s ease; 
        }
        .color-option-btn:hover:not(:disabled) { transform: scale(1.2); }
        .color-option-btn.active { box-shadow: 0 0 0 2px #E87A90; }
        .color-option-btn:disabled { opacity: 0.2; cursor: not-allowed; filter: grayscale(1); }

        .ls-3 { letter-spacing: 3px; }
        .ls-2 { letter-spacing: 2px; }

        @media (min-width: 992px) {
            .ps-lg-3 {
                position: sticky;
                top: 100px;
            }
        }
    </style>
    
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb extra-small text-uppercase ls-1 px-2">
            <li class="breadcrumb-item"><a href="{{ route('shop.index') }}" class="text-decoration-none text-muted">Archive</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop.index', ['category' => $product->category_id]) }}" class="text-decoration-none text-muted">{{ $product->category->name ?? 'Collection' }}</a></li>
            <li class="breadcrumb-item active fw-bold text-dark" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row g-4 g-lg-5">
        <!-- Gallery Section -->
        <div class="col-lg-7">
            <div class="row g-3">
                @if($allImages->count() > 1)
                <div class="col-md-2 d-none d-md-block">
                    <div class="d-flex flex-column gap-3 thumbnail-scroll-container">
                        @foreach($allImages as $index => $img)
                            <div class="ratio ratio-4x5 cursor-pointer rounded-3 overflow-hidden border-2 transition-premium shadow-sm" 
                                 :style="mainImage === '{{ $img->url }}' ? 'border-color: #E87A90; opacity: 1;' : 'border-color: transparent; opacity: 0.5;'"
                                 @click="mainImage = '{{ $img->url }}'">
                                <img src="{{ $img->url }}" class="object-fit-cover w-100 h-100" alt="View detail {{ $index + 1 }}">
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="{{ $allImages->count() > 1 ? 'col-md-10' : 'col-md-12' }}">
                    <div class="position-relative overflow-hidden rounded-4 bg-light shadow-sm gallery-main-container">
                        <img :src="mainImage" class="w-100 h-100 object-fit-cover main-display-img" 
                             x-transition:enter="transition ease-out duration-300" 
                             x-transition:enter-start="opacity-0" 
                             x-transition:enter-end="opacity-100" 
                             :key="mainImage"
                             alt="{{ $product->name }}">
                        
                        <div class="position-absolute top-0 start-0 p-3 pt-4">
                            <span class="badge bg-white bg-opacity-95 text-dark text-uppercase ls-1 px-3 py-2 rounded-pill shadow-sm border-0 font-heading fw-bold" style="font-size: 0.6rem;">
                                 {{ $product->aesthetic }} Curator's Collection
                            </span>
                        </div>
                    </div>

                    @if($allImages->count() > 1)
                    <div class="d-md-none d-flex gap-2 mt-3 overflow-auto pb-2 scrollbar-hide">
                        @foreach($allImages as $img)
                            <div class="flex-shrink-0 cursor-pointer rounded-3 overflow-hidden border-2 shadow-sm" 
                                 style="width: 70px; aspect-ratio: 4/5;"
                                 :style="mainImage === '{{ $img->url }}' ? 'border-color: #E87A90;' : 'border-color: transparent;'"
                                 @click="mainImage = '{{ $img->url }}'">
                                <img src="{{ $img->url }}" class="w-100 h-100 object-fit-cover" alt="View detail">
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Info & Buy Section -->
        <div class="col-lg-5">
            <div class="ps-lg-3">
                <div class="mb-4">
                    <span class="text-muted extra-small text-uppercase ls-2 fw-bold mb-2 d-block opacity-50">SKU: CP-{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</span>
                    <h1 class="font-heading fw-bold mb-2 display-6" style="letter-spacing: -1px;">{{ $product->name }}</h1>
                    <div class="d-flex align-items-center gap-3 mt-2">
                        @if($product->hasDiscount())
                            <span class="h3 mb-0 fw-bold font-heading text-dark">{{ number_format($product->discounted_price, 0) }} JOD</span>
                            <span class="text-muted text-decoration-line-through small">{{ number_format($product->price, 0) }} JOD</span>
                            <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-1 text-uppercase fw-bold" style="font-size: 0.6rem;">-{{ (float)$product->effective_discount }}% Exclusive</span>
                        @else
                            <span class="h3 mb-0 fw-bold font-heading text-dark">{{ number_format($product->price, 0) }} JOD</span>
                        @endif
                        
                        @if($this->getStockForVariant() <= 0)
                            <span class="badge bg-soft-blush text-primary rounded-pill px-3 py-1 text-uppercase fw-bold" style="font-size: 0.6rem;">Sold Out Combination</span>
                        @endif
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span class="badge bg-dark rounded-pill px-3 py-1 text-uppercase ls-1 fw-bold" style="font-size: 0.6rem;">Archive of {{ $product->brand_name ?? 'Chic Elite' }}</span>
                        @foreach($product->occasions ?? [] as $occ)
                            <span class="badge bg-light text-dark rounded-pill px-2 py-1 text-uppercase ls-1 opacity-75" style="font-size: 0.55rem; border: 1px solid rgba(0,0,0,0.1);">{{ $occ }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="p-4 rounded-4 bg-light border-0 mb-5">
                    <p class="text-muted mb-0 small" style="line-height: 1.7; font-family: 'Inter', sans-serif;">
                        {{ $product->description }}
                    </p>
                </div>

                <div class="mb-5">
                    @if(count($availableColors) > 0)
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-3 px-1">
                                <label class="extra-small text-muted text-uppercase fw-bold ls-2">Visual Tone</label>
                                <span class="extra-small text-dark fw-bold text-uppercase ls-1">{{ $selectedColor }}</span>
                            </div>
                            <div class="d-flex flex-wrap gap-3">
                                @foreach($availableColors as $color)
                                    <button wire:click="$set('selectedColor', '{{ $color }}')" 
                                            class="color-option-btn {{ $selectedColor === $color ? 'active' : '' }}"
                                            style="background-color: {{ $color }};" 
                                            {{ !$this->isColorAvailable($color) ? 'disabled' : '' }}
                                            title="{{ $color }} {{ !$this->isColorAvailable($color) ? '(Sold Out)' : '' }}">
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="mb-4">
                        <label class="extra-small text-muted text-uppercase fw-bold ls-2">Ascending Scale</label>
                        <a href="javascript:void(0)" class="extra-small text-muted text-decoration-none border-bottom border-muted text-uppercase ls-1 opacity-50">Size Matrix</a>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($product->sizes as $size)
                            <button wire:click="$set('selectedSize', '{{ $size }}')" 
                                    class="size-option-btn {{ $selectedSize === $size ? 'active' : '' }}"
                                    {{ !$this->isSizeAvailable($size) ? 'disabled' : '' }}>
                                {{ $size }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="d-flex gap-3 mb-5">
                    @if($this->getStockForVariant() > 0)
                        <button wire:click="addToCart" 
                                class="btn btn-dark btn-lg py-4 flex-grow-1 rounded-pill text-uppercase ls-2 fw-bold shadow-lg transition-premium">
                             <i class="fa-solid fa-bag-shopping me-3"></i> Add to Bag
                        </button>
                    @else
                        <button disabled class="btn btn-light btn-lg py-4 flex-grow-1 rounded-pill text-uppercase ls-1 fw-bold text-muted border">
                            {{ $selectedSize ? 'Unavailable' : 'Select Options' }}
                        </button>
                    @endif
                    
                    <livewire:wishlist-button :productId="$product->id" 
                            class="btn border border-2 rounded-circle d-flex align-items-center justify-content-center shadow-none boutique-wish-btn"
                            style="width: 65px; height: 65px;" />
                </div>

                <div class="border-top pt-4">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <i class="fa-solid fa-truck-fast text-dark opacity-75 small"></i>
                                <span class="extra-small text-uppercase ls-1 fw-bold">Amman Concierge</span>
                            </div>
                            <p class="text-muted extra-small mb-0 opacity-75">24-48 Hour Delivery</p>
                        </div>
                        <div class="col-6 text-end">
                            <div class="d-flex align-items-center gap-2 mb-1 justify-content-end">
                                <i class="fa-solid fa-gem text-dark opacity-75 small"></i>
                                <span class="extra-small text-uppercase ls-1 fw-bold">Authentic Archive</span>
                            </div>
                            <p class="text-muted extra-small mb-0 opacity-75">Certified Piece</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Review Section -->
    <div class="mt-5 pt-5 border-top" style="border-color: rgba(0,0,0,0.05) !important;">
        <livewire:product-reviews :productId="$product->id" />
    </div>

    <!-- Aesthetic recommendations -->
    @if($recommendations->count() > 0)
        <div class="mt-5 pt-5">
            <div class="text-center mb-5">
                <span class="text-muted extra-small text-uppercase ls-3 fw-bold mb-2 d-block opacity-50">Complete the Look</span>
                <h2 class="font-heading fw-bold h4">You Might Also Require</h2>
            </div>
            <div class="row g-4 px-2">
                @foreach($recommendations as $rec)
                    <div class="col-6 col-md-3">
                        <x-product-card :product="$rec" :badgeType="$rec->aesthetic" :badgeText="strtoupper($rec->aesthetic)" />
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <livewire:add-to-cart-suggestions />
</div>
