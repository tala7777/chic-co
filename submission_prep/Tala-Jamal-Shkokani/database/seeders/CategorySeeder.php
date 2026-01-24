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
        \App\Models\Category::firstOrCreate(['slug' => 'tops'], ['name' => 'Tops']);
        \App\Models\Category::firstOrCreate(['slug' => 'dresses'], ['name' => 'Dresses']);
        \App\Models\Category::firstOrCreate(['slug' => 'accessories'], ['name' => 'Accessories']);
        \App\Models\Category::firstOrCreate(['slug' => 'outerwear'], ['name' => 'Outerwear']);
    }
}
