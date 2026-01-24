<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;

class QuickAddToCart extends Component
{
    #[On('quick-add-to-cart')]
    public function addToCart($productId)
    {
        if (is_array($productId) && isset($productId['productId'])) {
            $productId = $productId['productId'];
        }

        \Log::info('Quick Add to Cart', ['productId' => $productId]);
        $product = Product::with('images')->find($productId);

        if (!$product || $product->stock <= 0) {
            $this->dispatch('swal:error', [
                'title' => 'Sold Out',
                'text' => 'This piece is no longer available in our collection.',
                'icon' => 'error'
            ]);
            return;
        }

        $cart = Session::get('cart', []);
        $cartKey = $productId;

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity']++;
        } else {
            $cart[$cartKey] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price ?? 0,
                'image' => $product->image ?? ($product->images->first()?->url ?? asset('images/placeholder.jpg')),
                'aesthetic' => $product->aesthetic,
                'size' => null,
                'color' => null,
                'quantity' => 1,
            ];
        }

        Session::put('cart', $cart);
        $this->dispatch('cart-updated', productId: $productId);
        $this->dispatch('open-cart');
    }

    public function render()
    {
        return view('livewire.quick-add-to-cart');
    }
}
