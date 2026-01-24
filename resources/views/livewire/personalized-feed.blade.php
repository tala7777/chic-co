<div class="container py-5 animate-fade-up">
    <!-- Header & Navigation -->
    <div class="text-center mb-5">
        <span class="text-muted extra-small text-uppercase ls-2 mb-3 d-block fw-bold">Exclusive Experience</span>
        <h1 class="display-3 font-heading fw-bold mb-4">
            The {{ ucfirst($aesthetic) }} Universe
        </h1>

        <!-- Page/View Navigation (Page 1, 2, 3) -->
        <div class="d-flex justify-content-center gap-2 mb-5">
            <button wire:click="setView('feed')"
                class="btn btn-sm rounded-pill px-4 py-2 transition-premium {{ $view === 'feed' ? 'btn-premium shadow-lg' : 'btn-light border text-muted' }}">
                1. The Daily Edit
            </button>
            <button wire:click="setView('moods')"
                class="btn btn-sm rounded-pill px-4 py-2 transition-premium {{ $view === 'moods' ? 'btn-premium shadow-lg' : 'btn-light border text-muted' }}">
                2. Style Calibration
            </button>
            <button wire:click="setView('lookbook')"
                class="btn btn-sm rounded-pill px-4 py-2 transition-premium {{ $view === 'lookbook' ? 'btn-premium shadow-lg' : 'btn-light border text-muted' }}">
                3. Private Lookbook
            </button>
        </div>

        @if($view === 'moods')
            <!-- Mood Filter (Page 2 specific) -->
            <div class="d-inline-flex bg-white rounded-pill shadow-sm p-2 border animate-fade-up">
                @foreach(['discover' => 'Discover', 'indulge' => 'Indulge', 'explore' => 'Explore'] as $m => $label)
                    <button wire:click="setMood('{{ $m }}')"
                        class="btn btn-sm rounded-pill px-5 py-2 transition-premium {{ $mood === $m ? 'btn-dark' : 'btn-light bg-transparent border-0 text-muted' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        @endif
    </div>

    @if($view === 'lookbook')
        <!-- Page 3: Private Lookbook View (Cinematic) -->
        <div class="row g-5 animate-fade-up">
            @forelse($products as $product)
                <div class="col-12 mb-5">
                    <div class="row align-items-center g-5">
                        <div class="col-lg-7">
                            <div class="card card-premium overflow-hidden shadow-none border-0 bg-light p-0">
                                <img src="{{ $product->image }}" class="w-100 object-fit-cover" style="height: 600px;"
                                    alt="{{ $product->name }}">
                            </div>
                        </div>
                        <div class="col-lg-5 text-start">
                            <span class="text-muted extra-small text-uppercase ls-2 mb-3 d-block fw-bold">Archive Piece</span>
                            <h2 class="display-4 font-heading fw-bold mb-4">{{ $product->name }}</h2>
                            <p class="text-muted fs-5 leading-relaxed mb-5">{{ $product->description }}</p>
                            <div class="d-flex align-items-center gap-4">
                                <h3 class="fw-bold mb-0">{{ number_format($product->price, 0) }} JOD</h3>
                                <livewire:add-to-cart-button :productId="$product->id" :key="'lookbook-' . $product->id"
                                    class="btn-premium px-5 py-3" />
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No pieces available for this lookbook.</p>
                </div>
            @endforelse
        </div>
    @else
        <!-- Product Grid (Page 1 & 2) -->
        <div class="row g-4 px-2">
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
                    <h4 class="font-heading fw-bold">The vibe is shifting.</h4>
                    <p class="text-muted small">We couldn't find items matching this exact frequency in our archives.</p>
                    <button wire:click="$set('aesthetic', 'mix')"
                        class="btn btn-premium px-5 py-3 mt-4 text-uppercase ls-1">View Modern Mix</button>
                </div>
            @endforelse
        </div>
    @endif

    @if($products->count() > 0)
        <div class="mt-5 d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    @endif

    <!-- Recommendations Sidebar -->
    <livewire:add-to-cart-suggestions />
</div>