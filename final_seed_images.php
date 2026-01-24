<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use App\Models\Image;

// Clear existing archival images to avoid duplicates and mess
Image::where('imageable_type', 'App\Models\Product')->delete();

$fashionImages = [
    'https://images.unsplash.com/photo-1539109136881-3be0616acf4b?q=80&w=800&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?q=80&w=800&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1434389677669-e08b4cac3105?q=80&w=800&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=800&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1469334031218-e382a71b716b?q=80&w=800&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1581044777550-4cfa60707c03?q=80&w=800&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1496747611176-843222e1e57c?q=80&w=800&auto=format&fit=crop',
    'https://images.unsplash.com/photo-1509631179647-0177331693ae?q=80&w=800&auto=format&fit=crop'
];

$products = Product::all();
foreach ($products as $product) {
    // Add exactly 3 unique archival images per product
    $selectedUrls = array_rand(array_flip($fashionImages), 3);

    foreach ($selectedUrls as $url) {
        Image::create([
            'url' => $url,
            'imageable_id' => $product->id,
            'imageable_type' => 'App\Models\Product'
        ]);
    }
}

echo "Final Archival Seeding Complete: " . $products->count() . " products updated with 3+ views.\n";
