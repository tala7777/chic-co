<div class="container-fluid py-5 px-lg-5 animate-fade-up">
    <!-- Fluid Header -->
    <div class="text-center mb-5">
        <span class="text-muted extra-small text-uppercase ls-2 mb-3 d-block fw-bold opacity-75">Private
            Collection</span>
        <h1 class="display-3 font-heading fw-bold mb-4">
            {{ $aesthetic === 'mix' ? 'The Modern Mix' : 'The ' . ucfirst($aesthetic) . ' Universe' }}
        </h1>

        <!-- View Navigation -->
        <div class="d-inline-flex bg-light rounded-pill p-2 shadow-sm border animate-fade-up">
            <button wire:click="setView('feed')"
                class="btn rounded-pill px-4 py-2 small fw-bold text-uppercase ls-1 transition-premium {{ $view === 'feed' ? 'bg-dark text-white shadow-lg' : 'text-muted' }}">
                The Edit
            </button>
            <button wire:click="setView('moods')"
                class="btn rounded-pill px-4 py-2 small fw-bold text-uppercase ls-1 transition-premium {{ $view === 'moods' ? 'bg-dark text-white shadow-lg' : 'text-muted' }}">
                Calibration
            </button>
            <button wire:click="setView('lookbook')"
                class="btn rounded-pill px-4 py-2 small fw-bold text-uppercase ls-1 transition-premium {{ $view === 'lookbook' ? 'bg-dark text-white shadow-lg' : 'text-muted' }}">
                Lookbook
            </button>
        </div>

        @if($view === 'moods')
            <div class="mt-4 animate-fade-up d-flex justify-content-center gap-3">
                @foreach(['discover' => 'Discover', 'indulge' => 'Indulge', 'explore' => 'Explore'] as $m => $label)
                    <button wire:click="setMood('{{ $m }}')"
                        class="btn btn-sm px-4 py-2 rounded-pill border-0 {{ $mood === $m ? 'bg-white shadow text-dark fw-bold' : 'text-muted' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        @endif
    </div>

    @if($view === 'lookbook')
        <!-- Page 3: Cinematic Lookbook View -->
        <div class="lookbook-view animate-fade-up mt-5">
            @forelse($products as $product)
                <div class="lookbook-section mb-5 py-5 border-top" wire:key="lookbook-{{ $product->id }}">
                    <div class="row align-items-center g-5">
                        <div class="col-lg-7">
                            <div class="lookbook-image-container overflow-hidden rounded-5 shadow-2xl">
                                <img src="{{ $product->image }}" class="w-100 h-100 object-fit-cover"
                                    style="min-height: 650px; transform: scale(1); transition: transform 0.8s ease;"
                                    onmouseover="this.style.transform='scale(1.05)'"
                                    onmouseout="this.style.transform='scale(1)'" alt="{{ $product->name }}">
                            </div>
                        </div>
                        <div class="col-lg-5 px-lg-5 text-start">
                            <div class="ps-lg-4">
                                <span
                                    class="badge bg-primary-subtle text-primary border-0 rounded-pill px-4 py-2 text-uppercase extra-small ls-1 fw-bold mb-4">
                                    {{ $product->aesthetic }} Curator's Pick
                                </span>
                                <h1 class="display-3 font-heading fw-bold mb-4" style="letter-spacing: -1px;">
                                    {{ $product->name }}</h1>
                                <p class="text-muted fs-5 leading-relaxed mb-5" style="opacity: 0.8;">
                                    {{ $product->description }}</p>

                                <div class="d-flex align-items-center justify-content-between pt-4 border-top border-light">
                                    <div>
                                        <span class="text-muted extra-small text-uppercase ls-1 d-block mb-1">Market
                                            Value</span>
                                        <h2 class="fw-bold mb-0" style="color: var(--color-ink-black);">
                                            {{ number_format($product->price, 0) }} JOD</h2>
                                    </div>
                                    <button wire:click="addToCart({{ $product->id }})"
                                        class="btn btn-dark rounded-pill px-5 py-3 fw-bold text-uppercase ls-1 shadow-lg hover-scale">
                                        Add To Bag
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Archives are currently empty for this session.</p>
                </div>
            @endforelse
        </div>
    @else
        <!-- View 1 & 2: Curated Feed -->
        <div class="row g-4 px-lg-4">
            @forelse($products as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <x-product-card :product="$product" :badgeText="strtoupper($product->aesthetic)"
                        :badgeType="$product->aesthetic" />
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="mb-4">
                        <i class="fa-solid fa-wand-magic-sparkles fa-3x text-muted opacity-25"></i>
                    </div>
                    <h4 class="font-heading fw-bold">Searching for the frequency...</h4>
                    <p class="text-muted small">We couldn't find items matching this exact vibe in our archives.</p>
                    <button wire:click="$set('aesthetic', 'mix')"
                        class="btn btn-premium px-5 py-3 mt-4 text-uppercase ls-1">View Entire Mix</button>
                </div>
            @endforelse
        </div>
    @endif

    @if($products->count() > 0)
        <div class="mt-5 d-flex justify-content-center pt-5">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    @endif

    <!-- Recommendations Sidebar -->
    <livewire:add-to-cart-suggestions />

    <style>
        .lookbook-section {
            scroll-margin-top: 100px;
        }

        .shadow-2xl {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        .lookbook-image-container {
            height: 750px;
        }
    </style>
</div>