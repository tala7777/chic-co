<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Services\CartService;

class FeaturedProducts extends Component
{
    public function addToCart($productId)
    {
        try {
            $cartService = new CartService();
            $cartService->add($productId);

            $this->dispatch('cart-updated');
            $this->dispatch('open-cart');

            \Log::info('FeaturedProducts Quick Add: Success', ['productId' => $productId]);
        } catch (\Exception $e) {
            \Log::error('FeaturedProducts Quick Add Error: ' . $e->getMessage());
            $this->dispatch('swal:error', ['title' => 'Error', 'text' => 'Could not update your bag.']);
        }
    }

    public function render()
    {
        // Get 4 featured products OR random products if none featured
        $products = Product::where('is_featured', true)
            ->where('status', 'active')
            ->where('stock', '>', 0)
            ->limit(4)
            ->get();

        if ($products->count() < 4) {
            $extra = Product::where('status', 'active')
                ->where('stock', '>', 0)
                ->whereNotIn('id', $products->pluck('id'))
                ->inRandomOrder()
                ->limit(4 - $products->count())
                ->get();
            $products = $products->concat($extra);
        }

        return view('livewire.featured-products', [
            'products' => $products
        ]);
    }
}
