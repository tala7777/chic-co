<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\Attributes\Layout;
use App\Services\StyleRecommendationService;

#[Layout('layouts.app')]
class ProductDetail extends Component
{
    public $product;
    public $recommendations;

    public function mount($id)
    {
        $this->product = Product::with(['category', 'images'])->findOrFail($id);

        // Track Recently Viewed
        $recentlyViewed = session()->get('recently_viewed', []);

        if (($key = array_search($id, $recentlyViewed)) !== false) {
            unset($recentlyViewed[$key]);
        }

        array_unshift($recentlyViewed, $id);
        $recentlyViewed = array_slice($recentlyViewed, 0, 5);
        session()->put('recently_viewed', $recentlyViewed);

        // Persistent Tracking for Authenticated Users
        if (auth()->check()) {
            \App\Models\UserBehavior::create([
                'user_id' => auth()->id(),
                'product_id' => $id,
                'action' => 'view'
            ]);
        }

        // Get recommendations via Style Service
        $styleService = new StyleRecommendationService();
        $this->recommendations = $styleService->getRecommendations(collect([$this->product]), 4);

        // Debug logging
        \Log::info('ProductDetail Recommendations Debug', [
            'product_id' => $id,
            'product_name' => $this->product->name,
            'product_aesthetic' => $this->product->aesthetic,
            'recommendations_count' => $this->recommendations->count(),
            'recommendations_ids' => $this->recommendations->pluck('id')->toArray(),
        ]);
    }

    public $selectedSize = 'M';
    public $selectedColor;

    public function addToCart()
    {
        $this->validate([
            'selectedSize' => 'nullable|string',
            'selectedColor' => 'nullable|string',
        ]);

        try {
            $cartService = new \App\Services\CartService();
            $cartService->add($this->product->id, 1, $this->selectedSize, $this->selectedColor);

            $this->dispatch('cart-updated');
            $this->dispatch('open-cart');
        } catch (\Exception $e) {
            \Log::error('ProductDetail AddToCart Error: ' . $e->getMessage());
            $this->dispatch('swal:error', ['title' => 'Error', 'text' => 'Could not update your bag.']);
        }
    }

    public function render()
    {
        return view('livewire.product-detail')
            ->title($this->product->name . ' - Chic & Co.');
    }
}
