<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Simulate users
        \App\Models\User::factory(10)->create();

        // Since we don't have the models created yet in this environment, 
        // normally we would do:
        // \App\Models\Product::factory(20)->create();
        // \App\Models\Order::factory(50)->create();

        // For now, I will create a basic Admin user if DB was connected
        // \App\Models\User::factory()->create([
        //     'name' => 'Admin User',
        //     'email' => 'admin@chic.co',
        // ]);
    }
}
