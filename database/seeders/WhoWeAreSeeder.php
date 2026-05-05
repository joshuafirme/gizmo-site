<?php

namespace Database\Seeders;

use App\Models\WhoWeAre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WhoWeAreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WhoWeAre::create([
            'badge_text' => 'Trusted Since 2010',
            'heading' => 'Your Partner in Digital Transformation',
            'main_content' => 'We provide end-to-end IT hardware procurement and consultancy services designed to help businesses scale efficiently.',
            'bullet_points' => [
                'Global logistics and rapid deployment',
                'Certified hardware engineers',
                '24/7 technical support and maintenance',
                'Eco-friendly hardware disposal'
            ],
        ]);
    }
}
