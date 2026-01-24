@props(['product', 'badgeType' => 'soft', 'badgeText' => ''])

<div {{ $attributes->merge(['class' => 'card-custom product-card h-100']) }} x-data="{ showQuick: false }"
    @mouseenter="showQuick = true" @mouseleave="showQuick = false">

    <!-- Image Container -->
    <div class="position-relative overflow-hidden img-shadow-overlay" style="aspect-ratio: 3/4;">
        @if($badgeText)
            <div class="aesthetic-badge aesthetic-{{ $badgeType }}">
                {{ $badgeText }}
            </div>
        @endif

        <a href="{{ url('/shop/' . $product['id']) }}">
            <img src="{{ $product['image'] ?? 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=600&auto=format&fit=crop' }}"
                class="w-100 h-100 object-fit-cover transition-all {{ ($product['stock'] ?? 1) <= 0 ? 'grayscale opacity-75' : '' }}"
                style="transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);"
                :style="showQuick ? 'transform: scale(1.05)' : ''" alt="{{ $product['name'] }}">

            @if(($product['stock'] ?? 1) <= 0)
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-white bg-opacity-40"
                    style="backdrop-filter: blur(4px); z-index: 5;">
                    <div class="text-center">
                        <div class="bg-dark text-white px-4 py-2 rounded-0 shadow-lg text-uppercase ls-2 fw-bold small mb-2"
                            style="letter-spacing: 3px;">
                            Archived
                        </div>
                        <div class="small fw-light text-dark text-uppercase ls-1" style="font-size: 0.65rem;">Sold Out</div>
                    </div>
                </div>
            @endif
        </a>

        <!-- Quick Actions Overlay -->
        <div class="quick-actions" x-show="showQuick" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-4"
            x-transition:enter-end="opacity-100 transform translate-y-0">
            <livewire:wishlist-button :productId="$product['id']" :wire:key="'wishlist-'.$product['id']" />
            <a href="{{ url('/shop/' . $product['id']) }}"
                class="btn-quick d-flex align-items-center justify-content-center text-decoration-none text-dark"
                title="View Details">
                <i class="fa-regular fa-eye"></i>
            </a>
            @if(($product['stock'] ?? 1) > 0)
                <button wire:click.prevent="addToCart({{ $product['id'] }})" class="btn-quick" title="Add to Cart">
                    <i class="fa-solid fa-cart-plus"></i>
                </button>
            @endif
        </div>
    </div>

    <!-- Content -->
    <div class="p-3 text-center">
        <p class="text-muted small text-uppercase ls-1 mb-1">{{ $product['category_name'] ?? 'Luxury Collection ' }}</p>
        <h5 class="h6 mb-2 fw-bold" style="font-family: var(--font-body);">{{ $product['name'] }}</h5>
        <div class="d-flex justify-content-center align-items-center gap-2">
            <span class="fw-bold" style="color: var(--color-ink-black);">{{ number_format($product['price'], 2) }}
                JOD</span>
            @if(isset($product['old_price']))
                <span class="text-muted text-decoration-line-through small">{{ number_format($product['old_price'], 2) }}
                    JOD</span>
            @endif
        </div>
    </div>
</div>