<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistButton extends Component
{
    public $productId;
    public $isWishlisted = false;

    public function mount($productId)
    {
        $this->productId = $productId;
        if (Auth::check()) {
            $this->isWishlisted = Wishlist::where('user_id', Auth::id())
                ->where('product_id', $this->productId)
                ->exists();
        }
    }

    public function toggleWishlist()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($this->isWishlisted) {
            Wishlist::where('user_id', Auth::id())
                ->where('product_id', $this->productId)
                ->delete();
            $this->isWishlisted = false;
            $this->dispatch('swal:success', [
                'title' => 'Removed',
                'text' => 'Item removed from wishlist.',
                'icon' => 'info'
            ]);
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $this->productId
            ]);
            $this->isWishlisted = true;
            $this->dispatch('swal:success', [
                'title' => 'Saved',
                'text' => 'Item added to your curated wishlist.',
                'icon' => 'success'
            ]);
        }

        $this->dispatch('wishlist-updated');
    }

    public function render()
    {
        return view('livewire.wishlist-button');
    }
}
