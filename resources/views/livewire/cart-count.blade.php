<div class="cart-icon-wrapper">
    <a class="nav-link p-0" data-bs-toggle="offcanvas" href="#cartSidebar" role="button" aria-controls="cartSidebar">
        <i class="fa-solid fa-bag-shopping fs-5"></i>
        @if($count > 0)
            <span class="cart-badge">{{ $count }}</span>
        @endif
    </a>
</div>