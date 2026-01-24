<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class StyleRecommendationService
{
    /**
     * Get tailored recommendations based on a user's style context.
     * Uses aesthetics, price tiers, and occasions for intelligent curation.
     */
    public function getRecommendations(Collection $currentItems = null, $limit = 4): Collection
    {
        $excludedIds = $currentItems ? $currentItems->pluck('id')->filter()->toArray() : [];

        // 1. Identify style context
        $stats = $this->analyzeStyleContext($currentItems);
        $dominantAesthetic = $stats['aesthetic'];
        $dominantPriceTier = $stats['price_tier'];
        $occasions = $stats['occasions'];

        // 2. High Match: Same Aesthetic AND match either Price Tier or Occasions
        $recommendations = Product::where('status', 'active')
            ->where('stock', '>', 0)
            ->whereNotIn('id', $excludedIds)
            ->where('aesthetic', $dominantAesthetic)
            ->where(function ($q) use ($dominantPriceTier, $occasions) {
                $q->where('price_tier', $dominantPriceTier);
                foreach ($occasions as $occasion) {
                    $q->orWhere('occasions', 'like', '%' . $occasion . '%');
                }
            })
            ->inRandomOrder()
            ->limit($limit)
            ->get();

        // 3. Medium Match: Just same Aesthetic
        if ($recommendations->count() < $limit) {
            $alreadyFound = $recommendations->pluck('id')->toArray();
            $more = Product::where('status', 'active')
                ->where('stock', '>', 0)
                ->whereNotIn('id', array_merge($excludedIds, $alreadyFound))
                ->where('aesthetic', $dominantAesthetic)
                ->inRandomOrder()
                ->limit($limit - $recommendations->count())
                ->get();

            $recommendations = $recommendations->concat($more);
        }

        // 4. Low Match/Global Discovery: High score products
        if ($recommendations->count() < $limit) {
            $alreadyFound = $recommendations->pluck('id')->toArray();
            $trending = Product::where('status', 'active')
                ->where('stock', '>', 0)
                ->whereNotIn('id', array_merge($excludedIds, $alreadyFound))
                ->orderBy('discover_score', 'desc')
                ->limit($limit - $recommendations->count())
                ->get();

            $recommendations = $recommendations->concat($trending);
        }

        return $recommendations;
    }

    /**
     * Deep analysis of the current selection to build a style profile.
     */
    private function analyzeStyleContext(Collection $items = null): array
    {
        $default = [
            'aesthetic' => 'mix',
            'price_tier' => 'mid',
            'occasions' => []
        ];

        if (!$items || $items->isEmpty()) {
            // Check browser session for recent style footprint
            $recentIds = session()->get('recently_viewed', []);
            if (!empty($recentIds)) {
                $recent = Product::whereIn('id', $recentIds)->get();
                return $this->analyzeStyleContext($recent);
            }
            return $default;
        }

        // Extract most frequent attributes
        $aesthetics = $items->pluck('aesthetic')->filter();
        $tiers = $items->pluck('price_tier')->filter();

        $allOccasions = [];
        foreach ($items as $item) {
            // Handle both Eloquent models and arrays
            if (is_object($item)) {
                $occ = $item->occasions ?? [];
            } else {
                $occ = $item['occasions'] ?? [];
            }

            // Decode if it's a JSON string
            if (is_string($occ)) {
                $occ = json_decode($occ, true) ?? [];
            }

            // Merge occasions
            if ($occ && is_array($occ)) {
                $allOccasions = array_merge($allOccasions, $occ);
            }
        }

        return [
            'aesthetic' => $aesthetics->countBy()->sortDesc()->keys()->first() ?? 'mix',
            'price_tier' => $tiers->countBy()->sortDesc()->keys()->first() ?? 'mid',
            'occasions' => array_slice(array_keys(array_count_values($allOccasions)), 0, 3)
        ];
    }
}
