<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LuxuryProductSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing to avoid duplicates if necessary, or just use updateOrCreate
        // For a clean seeder, we might want to truncate, but let's just be careful with slugs.

        $categories = Category::all()->pluck('id', 'slug')->toArray();

        $luxuryData = [
            // SOFT FEMME 🌸
            [
                'name' => 'Petal-Soft Charmeuse Maxi',
                'aesthetic' => 'soft',
                'price' => 285.00,
                'description' => 'A breathtaking maxi dress crafted from heavy-weight silk charmeuse. Features a delicate bias cut that skims the body, providing a fluid, ethereal silhouette. Perfect for golden hour soirées.',
                'category_slug' => 'dresses',
                'colors' => ['#FADADD', '#FFFFFF', '#E6E6FA'], // Blush, White, Lavender
                'sizes' => ['XS', 'S', 'M', 'L'],
                'image' => 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?q=80&w=800',
                'brand_name' => 'Atelier Rose',
                'occasions' => ['evening', 'wedding', 'gala'],
                'price_tier' => 'luxury',
                'gallery' => [
                    'https://images.unsplash.com/photo-1596783074918-c84cb06531ca?q=80&w=800',
                    'https://images.unsplash.com/photo-1496747611176-843222e1e57c?q=80&w=800',
                    'https://images.unsplash.com/photo-1518049362265-d5b2a6407b3b?q=80&w=800'
                ]
            ],
            [
                'name' => 'Vintage Lace Camisole',
                'aesthetic' => 'soft',
                'price' => 110.00,
                'description' => 'Hand-finished with delicate French Leavers lace, this 100% silk camisole is a versatile archive piece. Adjustable spaghetti straps and a subtle V-neckline make it perfect for layering.',
                'category_slug' => 'tops',
                'colors' => ['#FFFFFF', '#000000', '#F5BCBA'],
                'sizes' => ['S', 'M', 'L'],
                'brand_name' => 'Loom & Lace',
                'occasions' => ['daily', 'brunch'],
                'price_tier' => 'accessible',
                'image' => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?q=80&w=800',
                'gallery' => [
                    'https://images.unsplash.com/photo-1576188973526-0e5d742240ad?q=80&w=800',
                    'https://images.unsplash.com/photo-1595341888016-a392ef81b7de?q=80&w=800'
                ]
            ],
            [
                'name' => 'Pearl-Encrusted Hair Archive',
                'aesthetic' => 'soft',
                'price' => 45.00,
                'description' => 'A statement hair accessory featuring premium hand-stitched faux pearls on a velvet band. Adds a touch of regal elegance to any look.',
                'category_slug' => 'accessories',
                'colors' => ['#FFFFFF', '#F5F5DC'],
                'sizes' => ['OS'],
                'brand_name' => 'Bijoux Archive',
                'occasions' => ['formal', 'party'],
                'price_tier' => 'treat',
                'image' => 'https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?q=80&w=800',
                'gallery' => [
                    'https://images.unsplash.com/photo-1630019230531-158092780e90?q=80&w=800'
                ]
            ],

            // ALT GIRLY 🖤
            [
                'name' => 'Noir Vegan Leather Corset',
                'aesthetic' => 'alt',
                'price' => 195.00,
                'description' => 'Structured elegance meets rebellious spirit. This corset is crafted from premium, breathable vegan leather with silver-tone hardware and traditional lace-up backing for a perfect fit.',
                'category_slug' => 'tops',
                'colors' => ['#000000', '#8B0000'],
                'sizes' => ['XS', 'S', 'M', 'L'],
                'brand_name' => 'Midnight Edge',
                'occasions' => ['date_night', 'concert'],
                'price_tier' => 'aspirational',
                'image' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?q=80&w=800',
                'gallery' => [
                    'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=800',
                    'https://images.unsplash.com/photo-1583209814683-c023dd293cc6?q=80&w=800'
                ]
            ],
            [
                'name' => 'Buckled Platform Archive Boots',
                'aesthetic' => 'alt',
                'price' => 320.00,
                'description' => 'The ultimate foundation for the alt-girly aesthetic. These platform boots feature heavy-duty buckles, a reinforced sole, and a polished black finish that only gets better with wear.',
                'category_slug' => 'footwear',
                'colors' => ['#000000'],
                'sizes' => ['37', '38', '39', '40'],
                'brand_name' => 'Stride Noir',
                'occasions' => ['daily', 'event'],
                'price_tier' => 'luxury',
                'image' => 'https://images.unsplash.com/photo-1608256246200-53e635b5b65f?q=80&w=800',
                'gallery' => [
                    'https://images.unsplash.com/photo-1543163521-1bf539c55dd2?q=80&w=800'
                ]
            ],
            [
                'name' => 'Studded Silver Chain Bag',
                'aesthetic' => 'alt',
                'price' => 155.00,
                'description' => 'A compact yet edgy accessory. Features a chunky silver chain strap and subtle stud detailing on premium black leather. Holds the essentials for a night in the city.',
                'category_slug' => 'accessories',
                'colors' => ['#000000', '#C0C0C0'],
                'sizes' => ['OS'],
                'brand_name' => 'Chic Rebel',
                'occasions' => ['evening', 'party'],
                'price_tier' => 'accessible',
                'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=800',
                'gallery' => [
                    'https://images.unsplash.com/photo-1566150905458-1bf1fd15dbc4?q=80&w=800'
                ]
            ],

            // LUXURY CLEAN ✨
            [
                'name' => 'Architectural Neutral Trench',
                'aesthetic' => 'luxury',
                'price' => 640.00,
                'description' => 'The cornerstone of a curated wardrobe. This trench features a razor-sharp architectural cut, water-resistant gabardine fabric, and a signature belt that defines the waist with precision.',
                'category_slug' => 'outerwear',
                'colors' => ['#F5F5DC', '#A52A2A', '#000000'],
                'sizes' => ['S', 'M', 'L', 'XL'],
                'brand_name' => 'Studio Minimal',
                'occasions' => ['travel', 'office'],
                'price_tier' => 'luxury',
                'image' => 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?q=80&w=800',
                'gallery' => [
                    'https://images.unsplash.com/photo-1434389677669-e08b4cac3105?q=80&w=800',
                    'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?q=80&w=800'
                ]
            ],
            [
                'name' => 'Minimalist Silk Column Gown',
                'aesthetic' => 'luxury',
                'price' => 890.00,
                'description' => 'Quiet luxury at its finest. This column gown is made from double-faced silk that drapes with significant weight. Features a clean neckline and zero visible stitching for a truly seamless appearance.',
                'category_slug' => 'dresses',
                'colors' => ['#E5E4E2', '#000000', '#FFD700'],
                'sizes' => ['XS', 'S', 'M', 'L'],
                'brand_name' => 'Pure Form',
                'occasions' => ['formal', 'wedding'],
                'price_tier' => 'luxury',
                'image' => 'https://images.unsplash.com/photo-1566174053879-31528523f8ae?q=80&w=800',
                'gallery' => [
                    'https://images.unsplash.com/photo-1539109136881-3be0616acf4b?q=80&w=800',
                    'https://images.unsplash.com/photo-1509631179647-0177331693ae?q=80&w=800'
                ]
            ],
            [
                'name' => 'Essential Neutral Mule',
                'aesthetic' => 'luxury',
                'price' => 245.00,
                'description' => 'Crafted in Italy from ultra-soft kid leather, these pointed-toe mules are designed for all-day comfort without sacrificing style. A staple for the clean-girl aesthetic.',
                'category_slug' => 'footwear',
                'colors' => ['#F5F5DC', '#FFFFFF', '#000000'],
                'sizes' => ['36', '37', '38', '39', '40'],
                'brand_name' => 'Solace Steps',
                'occasions' => ['daily', 'office'],
                'price_tier' => 'aspirational',
                'image' => 'https://images.unsplash.com/photo-1543163521-1bf539c55dd2?q=80&w=800',
                'gallery' => [
                    'https://images.unsplash.com/photo-1512374382149-4332c6c02151?q=80&w=800'
                ]
            ],

            // MODERN MIX 🎭
            [
                'name' => 'Mixed-Media Pattern Blazer',
                'aesthetic' => 'mix',
                'price' => 420.00,
                'description' => 'A daring piece for the expressive individual. Combines traditional tailoring with modern, abstract printed panels. Each piece is a unique curation of fabric and form.',
                'category_slug' => 'tops',
                'colors' => ['#4B0082', '#008080', '#FF4500'],
                'sizes' => ['M', 'L', 'XL'],
                'brand_name' => 'Eclipse Mix',
                'occasions' => ['event', 'dinner'],
                'price_tier' => 'aspirational',
                'image' => 'https://images.unsplash.com/photo-1548142723-aae7678afd54?q=80&w=800',
                'gallery' => [
                    'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?q=80&w=800',
                    'https://images.unsplash.com/photo-1520004434532-668416a08753?q=80&w=800'
                ]
            ],
            [
                'name' => 'Cosmopolitan Flare Pants',
                'aesthetic' => 'mix',
                'price' => 185.00,
                'description' => 'High-waisted and featuring a dramatic flare, these pants are made from high-recovery stretch fabric that provides both comfort and a structured silhouette.',
                'category_slug' => 'outerwear',
                'colors' => ['#000000', '#FFFFFF', '#FF00FF'],
                'sizes' => ['XS', 'S', 'M', 'L'],
                'brand_name' => 'Urban Edge',
                'occasions' => ['daily', 'street'],
                'price_tier' => 'accessible',
                'image' => 'https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?q=80&w=800',
                'gallery' => [
                    'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=800'
                ]
            ],
            [
                'name' => 'Abstract Resin Earrings',
                'aesthetic' => 'mix',
                'price' => 65.00,
                'description' => 'Wearable art. These hand-poured resin earrings feature suspended metallic flakes and a unique marbled pattern. No two pairs are exactly the same.',
                'category_slug' => 'accessories',
                'colors' => ['#FFD700', '#C0C0C0'],
                'sizes' => ['OS'],
                'brand_name' => 'Artifacts Co.',
                'occasions' => ['accessory', 'gift'],
                'price_tier' => 'treat',
                'image' => 'https://images.unsplash.com/photo-1506630448388-4e683c67ddb0?q=80&w=800',
                'gallery' => [
                    'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?q=80&w=800'
                ]
            ]
        ];

        foreach ($luxuryData as $p) {
            $product = Product::updateOrCreate(
                ['slug' => Str::slug($p['name'])],
                [
                    'name' => $p['name'],
                    'aesthetic' => $p['aesthetic'],
                    'price' => $p['price'],
                    'description' => $p['description'],
                    'category_id' => $categories[$p['category_slug']] ?? null,
                    'image' => $p['image'],
                    'sku' => 'CHIC-' . strtoupper(Str::random(8)),
                    'colors' => $p['colors'],
                    'sizes' => $p['sizes'],
                    'brand_name' => $p['brand_name'] ?? 'Chic Elite',
                    'occasions' => $p['occasions'] ?? ['special'],
                    'price_tier' => $p['price_tier'] ?? 'luxury',
                    'stock' => rand(20, 100),
                    'status' => 'active',
                    'discover_score' => rand(100, 500)
                ]
            );

            // Add Primary Image to Gallery too (for consistency)
            $product->images()->updateOrCreate(
                ['url' => $p['image']],
                ['alt_text' => $p['name'] . ' Main View', 'is_primary' => true, 'sort_order' => 0]
            );

            // Add Gallery Images
            if (isset($p['gallery'])) {
                foreach ($p['gallery'] as $index => $gUrl) {
                    $product->images()->updateOrCreate(
                        ['url' => $gUrl],
                        ['alt_text' => $p['name'] . ' Detail ' . ($index + 1), 'is_primary' => false, 'sort_order' => $index + 1]
                    );
                }
            }

            // Create Variants
            $product->variants()->delete(); // Clear old variants
            foreach ($p['colors'] as $color) {
                foreach ($p['sizes'] as $size) {
                    $product->variants()->create([
                        'color' => $color,
                        'size' => $size,
                        'stock' => rand(5, 15)
                    ]);
                }
            }
        }
    }
}
