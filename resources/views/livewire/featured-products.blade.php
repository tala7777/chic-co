<div class="row g-4">
    @foreach($products as $product)
        <div class="col-6 col-md-3">
            <x-product-card :product="$product->toArray()" :badgeType="$product->aesthetic"
                :badgeText="ucfirst($product->aesthetic)" />
        </div>
    @endforeach
</div>