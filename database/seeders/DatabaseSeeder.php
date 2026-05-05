<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // SystemSettingsSeeder::class,
            // HeroSliderSeeder::class,
            // ProductCategorySeeder::class, // Must be before Subcategories
            WhoWeAreSeeder::class,
            ClientReviewSeeder::class,
            AboutUsSeeder::class,
        ]);
    }
}
