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
        // Use standard session ID which is now database-backed and stable
        return session()->getId();
    }

    /**
     * Add an item to the bag (Database-backed).
     */
    public function add($productId, $quantity = 1, $size = null, $color = null)
    {
        $visitorId = $this->getVisitorId();
        $userId = auth()->id();

        $item = CartItem::where('session_id', $visitorId)
            ->where('product_id', $productId)
            ->where('size', $size)
            ->where('color', $color)
            ->first();

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

        return CartItem::with('product')
            ->where('session_id', $visitorId)
            ->get();
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
            return $item->product->price * $item->quantity;
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
        CartItem::where('session_id', $this->getVisitorId())->delete();
    }
}
