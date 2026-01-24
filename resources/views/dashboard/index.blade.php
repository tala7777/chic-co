@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')
    @php 
        /** @var \App\Models\User $user */ 
        $user = Auth::user(); 
        
        $recentIds = session()->get('recently_viewed', []);
        $recentDiscoveries = \App\Models\Product::with('images')->whereIn('id', $recentIds)->get();
        // Preserve order
        $recentDiscoveries = $recentDiscoveries->sortBy(function($model) use ($recentIds) {
            return array_search($model->id, $recentIds);
        });
    @endphp
    <div class="container py-5 animate-fade-up">
        <div class="row">
            <div class="col-lg-3 mb-4">
                <div class="card card-premium p-4">
                    <div class="d-flex align-items-center mb-4 px-2">
                        <div class="bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fa-solid fa-user-tie fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="mb-0 font-heading">{{ $user->name }}</h5>
                            <span class="text-muted extra-small text-uppercase ls-1">Elite Member</span>
                        </div>
                    </div>

                    @if($recentDiscoveries->count() > 0)
                        <div class="mb-4 px-2">
                            <p class="text-uppercase text-muted fw-bold ls-1 mb-2" style="font-size: 0.6rem;">Recently Viewed</p>
                            <div class="d-flex gap-2 pb-2" style="overflow-x: auto; scrollbar-width: none;">
                                @foreach($recentDiscoveries as $product)
                                    <a href="{{ route('shop.show', $product->id) }}" class="flex-shrink-0">
                                        <div class="rounded-circle border overflow-hidden shadow-sm" style="width: 45px; height: 45px;">
                                            <img src="{{ $product->images->first()?->url ?? asset('images/placeholder.jpg') }}" 
                                                 alt="{{ $product->name }}"
                                                 class="w-100 h-100 object-fit-cover transition-transform duration-300 hover-scale"
                                                 style="transform: scale(1.1);">
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="nav flex-column nav-pills gap-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link border-0 text-start px-4 py-3 active d-flex align-items-center rounded-pill" 
                                id="v-pills-orders-tab" data-bs-toggle="pill" data-bs-target="#orders" type="button" role="tab">
                            <i class="fa-solid fa-box-open me-3"></i> Experiences
                        </button>
                        <button class="nav-link border-0 text-start px-4 py-3 d-flex align-items-center rounded-pill" 
                                id="v-pills-wishlist-tab" data-bs-toggle="pill" data-bs-target="#wishlist" type="button" role="tab">
                            <i class="fa-solid fa-gem me-3"></i> Curations
                        </button>
                        <button class="nav-link border-0 text-start px-4 py-3 d-flex align-items-center rounded-pill" 
                                id="v-pills-addresses-tab" data-bs-toggle="pill" data-bs-target="#addresses" type="button" role="tab">
                            <i class="fa-solid fa-map-pin me-3"></i> Destinations
                        </button>
                        <button class="nav-link border-0 text-start px-4 py-3 d-flex align-items-center rounded-pill" 
                                id="v-pills-payments-tab" data-bs-toggle="pill" data-bs-target="#payments" type="button" role="tab">
                            <i class="fa-solid fa-wallet me-3"></i> Treasury
                        </button>
                        <button class="nav-link border-0 text-start px-4 py-3 d-flex align-items-center rounded-pill" 
                                id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#profile" type="button" role="tab">
                            <i class="fa-solid fa-wand-magic-sparkles me-3"></i> Style Identity
                        </button>

                        <div class="border-top my-3"></div>

                        @if($user->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                                class="nav-link border-0 text-start px-4 py-3 d-flex align-items-center rounded-pill text-primary">
                                <i class="fa-solid fa-shield-halved me-3"></i> curator@admin
                            </a>
                        @endif

                        <a href="{{ route('logout') }}"
                            class="nav-link border-0 text-start px-4 py-3 d-flex align-items-center rounded-pill text-danger"
                            onclick="event.preventDefault(); document.getElementById('dashboard-logout-form').submit();">
                            <i class="fa-solid fa-power-off me-3"></i> Departure
                        </a>
                        <form id="dashboard-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="tab-content">
                    <!-- Orders Tab -->
                    <div class="tab-pane fade show active" id="orders">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="mb-0">Recent Orders</h4>
                            <a href="{{ route('account.orders') }}" class="small text-dark text-decoration-underline">View
                                Full Archive</a>
                        </div>

                        <livewire:user.recent-orders />
                    </div>

                    <!-- Wishlist Tab -->
                    <div class="tab-pane fade" id="wishlist">
                        <livewire:user.wishlist />
                    </div>

                    <!-- Addresses Tab -->
                    <div class="tab-pane fade" id="addresses">
                        <livewire:user.addresses />
                    </div>

                    <!-- Payments Tab -->
                    <div class="tab-pane fade" id="payments">
                        <livewire:user.payments />
                    </div>

                    <!-- Style Profile Tab -->
                    <div class="tab-pane fade" id="profile">
                        <livewire:user.profile-settings />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection