<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $aesthetic = $request->get('aesthetic');
        $priceTier = $request->get('price_tier');
        $sort = $request->get('sort', 'latest');
        $search = $request->get('search');

        $title = $aesthetic ? ucfirst($aesthetic) . ' Collection' : 'Explore Wonderland';

        $query = Product::with(['category', 'images']);

        if ($aesthetic) {
            $query->where('aesthetic', $aesthetic);
        }

        if ($priceTier) {
            $query->where('price_tier', $priceTier);
        }

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(12);

        return view('shop.index', compact('products', 'title', 'aesthetic', 'priceTier', 'sort', 'search'));
    }

    public function show($id)
    {
        $product = Product::with(['category', 'images'])->findOrFail($id);

        // Track Recently Viewed
        $recentlyViewed = session()->get('recently_viewed', []);

        // Remove if exists to move to front
        if (($key = array_search($id, $recentlyViewed)) !== false) {
            unset($recentlyViewed[$key]);
        }

        // Add to front
        array_unshift($recentlyViewed, $id);

        // Keep only last 5
        $recentlyViewed = array_slice($recentlyViewed, 0, 5);
        session()->put('recently_viewed', $recentlyViewed);

        // Get recommendations (same aesthetic or random)
        $recommendations = Product::where('aesthetic', $product->aesthetic)
            ->where('id', '!=', $id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('shop.show', compact('product', 'recommendations'));
    }
}
