<?php

namespace Database\Seeders;

use App\Models\HeroSlider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       HeroSlider::create([
            'title_badge' => 'Enterprise Architecture',
            'heading' => 'Scalable Data Center Solutions',
            'description' => 'Power your business with the latest in high-performance computing and modular server racks.',
            'image_path' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc51?q=80&w=2000&auto=format&fit=crop',
            'button_text' => 'View Inventory',
            'button_link' => '/products',
        ]);

        HeroSlider::create([
            'title_badge' => 'Cybersecurity First',
            'heading' => 'Next-Gen Network Security',
            'description' => 'Advanced firewall protection and encrypted hardware to safeguard your corporate assets.',
            'image_path' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=2000&auto=format&fit=crop',
            'button_text' => 'Get a Quote',
            'button_link' => '/contact',
        ]);
    }
}
