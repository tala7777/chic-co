<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartService
{
    /**
     * Get or create a persistent visitor ID.
     */
    public function getVisitorId()
    {
        if (!session()->has('cart_visitor_id')) {
            session()->put('cart_visitor_id', (string) Str::uuid());
            session()->save();
        }

        return session()->get('cart_visitor_id');
    }

    /**
     * Add an item to the bag (Database-backed).
     */
    public function add($productId, $quantity = 1, $size = null, $color = null)
    {
        $visitorId = $this->getVisitorId();
        $userId = auth()->id();

        $query = CartItem::where('product_id', $productId)
            ->where('size', $size)
            ->where('color', $color);

        if ($userId) {
            $query->where('user_id', $userId);
        } else {
            $query->where('session_id', $visitorId);
        }

        $item = $query->first();

        if ($item) {
            $item->increment('quantity', $quantity);
        } else {
            CartItem::create([
                'session_id' => $visitorId,
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'size' => $size,
                'color' => $color
            ]);
        }
    }

    /**
     * Get all items in the bag.
     */
    public function getItems()
    {
        $visitorId = $this->getVisitorId();
        $userId = auth()->id();

        $query = CartItem::with('product');

        if ($userId) {
            $query->where('user_id', $userId);
        } else {
            $query->where('session_id', $visitorId);
        }

        return $query->get();
    }

    /**
     * Remove an item.
     */
    public function remove($itemId)
    {
        CartItem::where('id', $itemId)->delete();
    }

    /**
     * Update quantity.
     */
    public function updateQuantity($itemId, $quantity)
    {
        if ($quantity <= 0) {
            $this->remove($itemId);
            return;
        }

        CartItem::where('id', $itemId)->update(['quantity' => $quantity]);
    }

    /**
     * Get subtotal.
     */
    public function getSubtotal()
    {
        return $this->getItems()->sum(function ($item) {
            return ($item->product->discounted_price ?? 0) * $item->quantity;
        });
    }

    /**
     * Link guest cart items to the user account after login/registration.
     */
    public function migrateGuestCartToUser($userId)
    {
        $visitorId = $this->getVisitorId();

        CartItem::where('session_id', $visitorId)
            ->whereNull('user_id')
            ->update(['user_id' => $userId]);

        \Log::info('Migrated guest items to user ID: ' . $userId);
    }

    /**
     * Clear the bag.
     */
    public function clear()
    {
        $visitorId = $this->getVisitorId();
        $userId = auth()->id();

        $query = CartItem::query();

        if ($userId) {
            $query->where('user_id', $userId);
        } else {
            $query->where('session_id', $visitorId);
        }

        $query->delete();
    }

    /**
     * Get total quantity of items in bag.
     */
    public function getCount()
    {
        $visitorId = $this->getVisitorId();
        $userId = auth()->id();

        $query = CartItem::query();

        if ($userId) {
            $query->where('user_id', $userId);
        } else {
            $query->where('session_id', $visitorId);
        }

        return $query->sum('quantity');
    }
}
