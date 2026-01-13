<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::create(['name' => 'Tops', 'slug' => 'tops']);
        \App\Models\Category::create(['name' => 'Dresses', 'slug' => 'dresses']);
        \App\Models\Category::create(['name' => 'Accessories', 'slug' => 'accessories']);
        \App\Models\Category::create(['name' => 'Outerwear', 'slug' => 'outerwear']);
    }
}
