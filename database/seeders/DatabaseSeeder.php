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
        $this->call([
            AdminUserSeeder::class,
            CategorySeeder::class,
            LuxuryProductSeeder::class,
            AttributeSeeder::class,
            PersonaUserSeeder::class,
            UserProfileSeeder::class,
            FullUserSeeder::class,
            EliteReviewSeeder::class,
            ReviewSeeder::class, // More generic ones for volume
        ]);
    }
}
