<?php

namespace Database\Seeders;

use App\Models\SystemSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SystemSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SystemSetting::create([
            'app_name' => 'Gizmo Systems',
            'description' => 'Global IT hardware distribution and enterprise solutions.',
            'version' => '1.2.0',
            'logo_path' => 'https://images.unsplash.com/photo-1614850523296-d8c1af93d400?q=80&w=300&auto=format&fit=crop', // Abstract Blue Tech Logo
            'contact_email' => 'support@gizmo-systems.com',
            'contact_phone' => '+1-555-0123',
        ]);
    }
}
