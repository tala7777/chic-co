<div class="offcanvas offcanvas-end" tabindex="-1" id="cartSidebar" aria-labelledby="cartSidebarLabel" wire:ignore.self>
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title font-heading fw-bold" id="cartSidebarLabel">YOUR BAG</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @if(count($cart) > 0)
            <div class="d-flex flex-column gap-3">
                @foreach($cart as $item)
                    <div class="d-flex gap-3 align-items-center border-bottom pb-3">
                        <div class="position-relative">
                            <img src="{{ $item['image'] ?? 'https://via.placeholder.com/60' }}" alt="{{ $item['name'] }}"
                                class="rounded shadow-sm" style="width: 70px; height: 85px; object-fit: cover;">
                            @if($item['out_of_stock'])
                                <span class="position-absolute top-0 start-0 badge bg-danger" style="font-size: 0.5rem;">Out of
                                    Stock</span>
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1 font-heading text-uppercase text-truncate" style="max-width: 150px;">
                                {{ $item['name'] }}
                            </h6>
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <p class="mb-0 text-muted small">{{ number_format((float) $item['price'], 0) }} JOD</p>
                                @if(isset($item['size']) && $item['size'])
                                    <span class="badge bg-light text-dark border py-1 px-2" style="font-size: 0.6rem;">Size:
                                        {{ $item['size'] }}</span>
                                @endif
                                @if(isset($item['color']) && $item['color'])
                                    <div class="rounded-circle border"
                                        style="width: 12px; height: 12px; background-color: {{ $item['color'] }};"
                                        title="Color: {{ $item['color'] }}"></div>
                                @endif
                            </div>

                            <div class="d-flex align-items-center justify-content-between">
                                <div class="btn-group btn-group-sm" role="group">
                                    <button class="btn btn-outline-secondary py-0 px-2"
                                        wire:click="decrement({{ $item['item_id'] }})">-</button>
                                    <button
                                        class="btn btn-outline-secondary py-0 px-2 disabled border-start-0 border-end-0 text-dark fw-bold"
                                        style="background: transparent; opacity: 1;">{{ $item['quantity'] }}</button>
                                    <button class="btn btn-outline-secondary py-0 px-2"
                                        wire:click="increment({{ $item['item_id'] }})" @if($item['out_of_stock']) disabled
                                        @endif>+</button>
                                </div>
                                <button class="btn btn-link text-muted small p-0 text-decoration-none"
                                    wire:click="removeFromCart({{ $item['item_id'] }})">Remove</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="position-absolute bottom-0 start-0 w-100 bg-white border-top p-4">
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-uppercase fw-bold">Subtotal</span>
                    <span class="fw-bold fs-5">{{ number_format((float) $total, 0) }} JOD</span>
                </div>
                <p class="text-muted small mb-3">Shipping & taxes calculated at checkout.</p>
                <div class="d-grid gap-2">
                    <a href="{{ url('/checkout') }}" class="btn btn-dark py-3 rounded-0 text-uppercase ls-1">Checkout</a>
                </div>
            </div>
        @else
            <div class="py-5 d-flex flex-column align-items-center justify-content-center text-center">
                <i class="fa-thin fa-bag-shopping fa-3x text-muted mb-3"></i>
                <h5 class="text-muted mb-2">Your bag is empty</h5>
                <p class="text-muted small mb-0 px-4">Find your aesthetic in our curated collections.</p>
            </div>
        @endif

        @if(count($recommendations) > 0)
            <div class="mt-5 pt-4 border-top">
                <p class="small text-uppercase fw-bold ls-1 mb-3">CURATED FOR YOUR STYLE</p>
                <div class="row g-3">
                    @foreach($recommendations as $rec)
                        <div class="col-4">
                            <a href="{{ url('/product/' . $rec->id) }}" class="text-decoration-none">
                                <div class="position-relative mb-1">
                                    <img src="{{ $rec->image ?? ($rec->images->first()?->url ?? asset('images/placeholder.jpg')) }}"
                                        class="rounded w-100 shadow-sm" style="height: 100px; object-fit: cover;">
                                    <div class="aesthetic-badge aesthetic-{{ $rec->aesthetic }} position-absolute bottom-0 start-0 m-1"
                                        style="font-size: 0.4rem; padding: 2px 5px;">
                                        {{ $rec->aesthetic }}
                                    </div>
                                </div>
                                <p class="small text-dark text-truncate mb-0" style="font-size: 0.7rem;">{{ $rec->name }}</p>
                                <p class="small text-muted" style="font-size: 0.6rem;">{{ number_format($rec->price, 0) }} JOD
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>