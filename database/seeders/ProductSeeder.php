<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $tops = Category::where('slug', 'tops')->first();

        $p1 = Product::create([
            'name' => 'Classic Silk Blouse',
            'slug' => 'classic-silk-blouse',
            'sku' => 'TS-001',
            'price' => 85.00,
            'description' => 'A timeless silk blouse for any occasion.',
            'category_id' => $tops->id,
            'stock' => 100,
            'status' => 'active',
            'is_featured' => true,
        ]);

        // Create variants for P1
        $p1->variants()->createMany([
            ['sku' => 'TS-001-S-BK', 'stock_quantity' => 10],
            ['sku' => 'TS-001-M-BK', 'stock_quantity' => 20],
        ]);
    }
}
