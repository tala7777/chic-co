@props(['product', 'badgeType' => 'soft', 'badgeText' => ''])

<div {{ $attributes->merge(['class' => 'product-card h-100 position-relative group']) }}>

    <!-- Image Wrapper -->
    <div class="img-shadow-overlay overflow-hidden position-relative rounded-4 bg-light" style="aspect-ratio: 3/4;">
        <a href="{{ url('/shop/' . $product['id']) }}" class="d-block w-100 h-100">
            <img src="{{ $product['image'] ?? 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=600&auto=format&fit=crop' }}"
                alt="{{ $product['name'] }}"
                class="w-100 h-100 object-fit-cover transition-premium group-hover-scale {{ ($product['stock'] ?? 1) <= 0 ? 'grayscale opacity-75' : '' }}">
        </a>

        <!-- Badges -->
        <div
            class="position-absolute top-0 start-0 p-3 w-100 d-flex justify-content-between align-items-start pointer-events-none">
            @if($badgeText)
                <span class="aesthetic-badge aesthetic-{{ $badgeType }} shadow-sm">
                    {{ $badgeText }}
                </span>
            @endif

            @if(($product['stock'] ?? 1) <= 0)
                <span class="badge bg-white text-dark shadow-sm text-uppercase ls-1 fw-bold border"
                    style="font-size: 0.6rem;">Sold Out</span>
            @endif
        </div>

        <!-- Quick Actions (Hover) -->
        <div class="quick-actions opacity-0 group-hover-opacity-100 transition-premium mb-3">
            <livewire:wishlist-button :productId="$product['id']" :wire:key="'wishlist-'.$product['id']"
                class="btn-quick" />

            <a href="{{ url('/shop/' . $product['id']) }}" class="btn-quick text-decoration-none" title="View">
                <i class="fa-regular fa-eye"></i>
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="pt-4 pb-2 text-center px-2">
        <h3 class="h6 font-heading fw-bold mb-1 text-dark text-truncate">
            <a href="{{ url('/shop/' . $product['id']) }}" class="text-dark text-decoration-none">
                {{ $product['name'] }}
            </a>
        </h3>

        <p class="small text-muted mb-3" style="color: var(--color-warm-gold) !important; font-weight: 500;">
            {{ number_format($product['price'], 2) }} JOD
        </p>

        <!-- Add to Bag Button -->
        @if(($product['stock'] ?? 1) > 0)
            <button @click="Livewire.dispatch('quick-add-to-cart', { productId: {{ $product['id'] }} })"
                class="btn btn-primary-custom w-100 rounded-pill py-2 extra-small text-uppercase fw-bold ls-1 shadow-sm transition-premium hover-translate-up">
                Add to Bag
            </button>
        @else
            <button disabled
                class="btn btn-outline-secondary w-100 rounded-pill py-2 extra-small text-uppercase fw-bold ls-1 border-0 bg-light text-muted">
                Unavailable
            </button>
        @endif
    </div>
</div>