<div>
    <h4 class="mb-4 font-heading">My Curated Wishlist</h4>
    <div class="row g-4">
        @forelse($wishlistItems as $item)
            @if($item->product)
                <div class="col-md-4">
                    <div class="card card-premium h-100 animate-fade-up shadow-none border">
                        <div class="position-relative overflow-hidden" style="height: 280px;">
                            <img src="{{ $item->product->image }}" class="w-100 h-100 object-fit-cover"
                                alt="{{ $item->product->name }}">
                            <div class="position-absolute top-0 end-0 m-3">
                                <button class="btn btn-white btn-sm rounded-circle shadow-sm"
                                    style="width: 35px; height: 35px; padding: 0;"
                                    wire:click="removeFromWishlist({{ $item->id }})">
                                    <i class="fa-solid fa-xmark text-danger"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <span
                                class="extra-small text-muted text-uppercase ls-1 d-block mb-1">{{ $item->product->aesthetic }}</span>
                            <h6 class="mb-3 text-truncate font-heading fs-5">{{ $item->product->name }}</h6>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="fw-bold fs-5 text-dark">{{ number_format($item->product->price, 0) }} JOD</span>
                                <a href="{{ route('shop.show', $item->product->id) }}"
                                    class="btn btn-premium btn-sm py-2 px-4 shadow-none">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <div class="col-12">
                <div class="text-center py-5 bg-light rounded-5 border-dashed">
                    <i class="fa-solid fa-heart-crack fs-1 mb-3 opacity-25"></i>
                    <p class="text-muted mb-4">Your curation list is looking a bit sparse.</p>
                    <a href="{{ route('shop.index') }}" class="btn btn-premium px-5 py-3">Discover Collections</a>
                </div>
            </div>
        @endforelse
    </div>
</div>