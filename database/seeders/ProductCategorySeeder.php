<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Networking Category
        $networking = ProductCategory::create([
            'name' => 'Networking',
            'slug' => 'networking',
            'description' => 'Enterprise switches and wireless infrastructure.'
        ]);

        $switches = ProductSubcategory::create([
            'category_id' => $networking->id,
            'name' => 'Managed Switches',
            'slug' => 'managed-switches'
        ]);

        Product::create([
            'subcategory_id' => $switches->id,
            'name' => 'Nexus Core-8000 Switch',
            'slug' => 'nexus-core-8000',
            'description' => '48-port Layer 3 managed switch with 10G SFP+ uplinks.',
            'image_path' => 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?q=80&w=800&auto=format&fit=crop',
            'icon_class' => 'fa-network-wired',
            'is_featured' => true
        ]);

        // Server Category
        $servers = ProductCategory::create([
            'name' => 'Server Hardware',
            'slug' => 'server-hardware',
            'description' => 'High-density rack and blade servers.'
        ]);

        $rackServers = ProductSubcategory::create([
            'category_id' => $servers->id,
            'name' => 'Rack Servers',
            'slug' => 'rack-servers'
        ]);

        Product::create([
            'subcategory_id' => $rackServers->id,
            'name' => 'Titan 2U Dual-Processor Server',
            'slug' => 'titan-2u-dual',
            'description' => 'Optimized for virtualization and heavy cloud workloads.',
            'image_path' => 'https://images.unsplash.com/photo-1597852074816-d933c4d2b988?q=80&w=800&auto=format&fit=crop',
            'icon_class' => 'fa-server',
            'is_featured' => true
        ]);
    }
}
