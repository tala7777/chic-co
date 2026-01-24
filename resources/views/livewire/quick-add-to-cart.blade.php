<div>
    @if($isOpen && $product)
        <div class="position-fixed top-0 start-0 w-100 h-100 z-50 d-flex align-items-center justify-content-center"
            style="z-index: 1050; background: rgba(0,0,0,0.6); backdrop-filter: blur(5px);">

            <!-- Modal Card -->
            <div class="bg-white rounded-5 shadow-lg overflow-hidden position-relative w-100 mx-3 animate-fade-up"
                style="max-width: 800px; animation-duration: 0.3s;">

                <button wire:click="close" class="position-absolute top-0 end-0 m-4 btn-close z-10 p-2"></button>

                <div class="row g-0">
                    <!-- Product Image -->
                    <div class="col-md-6 bg-light" style="min-height: 400px;">
                        <img src="{{ $product->image ?? ($product->images->first()?->url ?? asset('images/placeholder.jpg')) }}"
                            alt="{{ $product->name }}" class="w-100 h-100 object-fit-cover">
                    </div>

                    <!-- Selection Form -->
                    <div class="col-md-6 p-5 d-flex flex-column">
                        <div class="mb-auto">
                            <span
                                class="text-muted extra-small text-uppercase ls-2 fw-bold mb-2 d-block">{{ $product->brand_name ?? 'Chic & Co.' }}</span>
                            <h2 class="font-heading fw-bold mb-2">{{ $product->name }}</h2>
                            <p class="fs-5 text-dark mb-4" style="color: var(--color-warm-gold) !important;">
                                {{ number_format($product->price, 2) }} JOD
                            </p>

                            <!-- Size Selection -->
                            @if(!empty($product->sizes))
                                <div class="mb-4">
                                    <label class="d-block small fw-bold text-uppercase ls-1 mb-2">Select Size</label>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($product->sizes as $size)
                                            <button type="button" wire:click="$set('selectedSize', '{{ $size }}')"
                                                class="btn btn-sm rounded-pill px-3 py-2 fw-bold {{ $selectedSize === $size ? 'bg-dark text-white' : 'btn-outline-dark border-secondary-subtle text-dark' }}"
                                                style="min-width: 45px;">
                                                {{ $size }}
                                            </button>
                                        @endforeach
                                    </div>
                                    @error('selectedSize') <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            @else
                                <div class="mb-4">
                                    <span class="badge bg-light text-dark border rounded-pill px-3">One Size</span>
                                </div>
                            @endif

                            <!-- Color Selection -->
                            @if(!empty($product->colors))
                                <div class="mb-4">
                                    <label class="d-block small fw-bold text-uppercase ls-1 mb-2">Select Color</label>
                                    <div class="d-flex gap-2">
                                        @foreach($product->colors as $color)
                                            <button type="button" wire:click="$set('selectedColor', '{{ $color }}')"
                                                class="rounded-circle border d-flex align-items-center justify-content-center p-0 transition-premium"
                                                style="width: 32px; height: 32px; background-color: {{ strtolower($color) }}; {{ $selectedColor === $color ? 'box-shadow: 0 0 0 2px white, 0 0 0 4px var(--color-ink-black);' : '' }}"
                                                title="{{ $color }}">
                                            </button>
                                        @endforeach
                                    </div>
                                    @error('selectedColor') <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="mt-4 pt-3 border-top">
                            <button wire:click="addToBag" wire:loading.attr="disabled"
                                class="btn-primary-custom w-100 py-3 fs-6 d-flex justify-content-center align-items-center gap-2">
                                <span wire:loading.remove>Add to Bag</span>
                                <span wire:loading><i class="fas fa-spinner fa-spin"></i> Adding...</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>