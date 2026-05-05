<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutUs::create([
            'section_title' => 'Our Core Values',
            'json_content' => [
                'mission' => 'To bridge the gap between technology and business growth.',
                'vision' => 'To be the global standard for IT infrastructure supply.',
                'values' => ['Integrity', 'Innovation', 'Customer Success', 'Sustainability']
            ],
        ]);
    }
}
