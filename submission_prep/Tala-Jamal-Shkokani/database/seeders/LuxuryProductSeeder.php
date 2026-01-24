<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LuxuryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Alt Girly 🖤
            [
                'name' => 'Midnight Edge Blazer',
                'aesthetic' => 'alt',
                'price' => 245,
                'price_tier' => 'aspirational',
                'image' => 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?q=80&w=600',
                'brand_name' => 'Abdoun Noir',
                'occasions' => ['evening', 'date_night'],
            ],
            [
                'name' => 'Studded Rebel Boots',
                'aesthetic' => 'alt',
                'price' => 180,
                'price_tier' => 'accessible',
                'image' => 'https://images.unsplash.com/photo-1608256246200-53e635b5b65f?q=80&w=600',
                'brand_name' => 'Chic Rebel',
                'occasions' => ['casual', 'event'],
            ],
            [
                'name' => 'Golden Spike Choker',
                'aesthetic' => 'alt',
                'price' => 65,
                'price_tier' => 'treat',
                'image' => 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?q=80&w=600',
                'brand_name' => 'Lux Alt',
                'occasions' => ['party'],
            ],
            [
                'name' => 'Velvet Noir Evening Gown',
                'aesthetic' => 'alt',
                'price' => 650,
                'price_tier' => 'luxury',
                'image' => 'https://images.unsplash.com/photo-1566174053879-31528523f8ae?q=80&w=600',
                'brand_name' => 'Royale Alt',
                'occasions' => ['formal', 'wedding'],
            ],
            [
                'name' => 'Chain Detail Mini Bag',
                'aesthetic' => 'alt',
                'price' => 120,
                'price_tier' => 'accessible',
                'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=600',
                'brand_name' => 'Street Luxury',
                'occasions' => ['daily', 'evening'],
            ],

            // Luxury Clean ✨
            [
                'name' => 'Ivory Silk Column Dress',
                'aesthetic' => 'luxury',
                'price' => 780,
                'price_tier' => 'luxury',
                'image' => 'https://images.unsplash.com/photo-1434389677669-e08b4cac3105?q=80&w=600',
                'brand_name' => 'Al-Rabieh White',
                'occasions' => ['formal', 'dinner'],
            ],
            [
                'name' => 'Cashmere Neutral Wrap',
                'aesthetic' => 'luxury',
                'price' => 320,
                'price_tier' => 'aspirational',
                'image' => 'https://images.unsplash.com/photo-1583337130417-3346a1be7dee?q=80&w=600',
                'brand_name' => 'Pure Comfort',
                'occasions' => ['travel', 'office'],
            ],
            [
                'name' => 'Minimalist Gold Hoop Set',
                'aesthetic' => 'luxury',
                'price' => 85,
                'price_tier' => 'accessible',
                'image' => 'https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?q=80&w=600',
                'brand_name' => 'Essential Gold',
                'occasions' => ['daily', 'work'],
            ],
            [
                'name' => 'Tailored Taupe Trousers',
                'aesthetic' => 'luxury',
                'price' => 210,
                'price_tier' => 'aspirational',
                'image' => 'https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?q=80&w=600',
                'brand_name' => 'Chic Studio',
                'occasions' => ['work', 'brunch'],
            ],
            [
                'name' => 'Quiet Luxury Silk Scarf',
                'aesthetic' => 'luxury',
                'price' => 45,
                'price_tier' => 'treat',
                'image' => 'https://images.unsplash.com/photo-1584030373081-f37b7bb4fa82?q=80&w=600',
                'brand_name' => 'Atelier Clean',
                'occasions' => ['accessory'],
            ],

            // Soft Femme 🌸
            [
                'name' => 'Rose Gold Satin Abaya',
                'aesthetic' => 'soft',
                'price' => 520,
                'price_tier' => 'luxury',
                'image' => 'https://images.unsplash.com/photo-1585487000160-6ebcfceb0d03?q=80&w=600',
                'brand_name' => 'Dabouq Dreams',
                'occasions' => ['formal', 'celebration'],
            ],
            [
                'name' => 'Blush Pearl Neckless',
                'aesthetic' => 'soft',
                'price' => 140,
                'price_tier' => 'accessible',
                'image' => 'https://images.unsplash.com/photo-1599643446516-80151abc2209?q=80&w=600',
                'brand_name' => 'Femme Bijoux',
                'occasions' => ['wedding', 'gift'],
            ],
            [
                'name' => 'Floral Chiffon Wrap Dress',
                'aesthetic' => 'soft',
                'price' => 280,
                'price_tier' => 'aspirational',
                'image' => 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?q=80&w=600',
                'brand_name' => 'Garden Chic',
                'occasions' => ['brunch', 'summer_night'],
            ],
            [
                'name' => 'Pink Silk Camisole',
                'aesthetic' => 'soft',
                'price' => 75,
                'price_tier' => 'treat',
                'image' => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?q=80&w=600',
                'brand_name' => 'Soft Essentials',
                'occasions' => ['layering', 'home'],
            ],
            [
                'name' => 'Pastel Bow Heels',
                'aesthetic' => 'soft',
                'price' => 195,
                'price_tier' => 'accessible',
                'image' => 'https://images.unsplash.com/photo-1543163521-1bf539c55dd2?q=80&w=600',
                'brand_name' => 'Step in Pink',
                'occasions' => ['party', 'date_night'],
            ],

            // Modern Mix 🎭
            [
                'name' => 'Cosmopolitan Textured Blazer',
                'aesthetic' => 'mix',
                'price' => 310,
                'price_tier' => 'aspirational',
                'image' => 'https://images.unsplash.com/photo-1548142723-aae7678afd54?q=80&w=600',
                'brand_name' => 'Swafeih Mood',
                'occasions' => ['office', 'evening'],
            ],
            [
                'name' => 'Abstract Print Silk Top',
                'aesthetic' => 'mix',
                'price' => 125,
                'price_tier' => 'accessible',
                'image' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=600',
                'brand_name' => 'Bold & Co.',
                'occasions' => ['daily', 'brunch'],
            ],
            [
                'name' => 'Pop Color Statement Bag',
                'aesthetic' => 'mix',
                'price' => 540,
                'price_tier' => 'luxury',
                'image' => 'https://images.unsplash.com/photo-1566150905458-1bf1fd15dbc4?q=80&w=600',
                'brand_name' => 'The Collector',
                'occasions' => ['event', 'investment'],
            ],
            [
                'name' => 'Neutral Coordinate Set',
                'aesthetic' => 'mix',
                'price' => 240,
                'price_tier' => 'aspirational',
                'image' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=600',
                'brand_name' => 'Mono Mix',
                'occasions' => ['travel', 'brunch'],
            ],
            [
                'name' => 'Eclectic Resin Earrings',
                'aesthetic' => 'mix',
                'price' => 35,
                'price_tier' => 'treat',
                'image' => 'https://images.unsplash.com/photo-1506630448388-4e683c67ddb0?q=80&w=600',
                'brand_name' => 'Artshield',
                'occasions' => ['accessory'],
            ],
        ];

        $categoryId = \App\Models\Category::first()->id ?? 1;

        foreach ($products as $p) {
            \App\Models\Product::create(array_merge($p, [
                'slug' => \Illuminate\Support\Str::slug($p['name']),
                'sku' => 'CHIC-' . \Illuminate\Support\Str::random(8),
                'category_id' => $categoryId,
                'status' => 'active',
                'stock' => 10,
                'discover_score' => rand(50, 500)
            ]));
        }
    }
}
