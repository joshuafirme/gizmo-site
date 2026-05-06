<?php

namespace App\Http\Controllers;

use App\Models\WhoWeAre;
use App\Models\AboutUs;
use App\Models\ClientReview;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

class PageController extends Controller
{
    public function about()
    {
        // Fetch active data for the About page
        $whoWeAre = WhoWeAre::where('is_active', true)->latest()->first();
        $aboutUs = AboutUs::where('is_active', true)->latest()->first();
        $reviews = ClientReview::where('is_active', true)->latest()->get();

        return view('site.about', compact('whoWeAre', 'aboutUs', 'reviews'));
    }

    public function reviews()
    {
        $reviews = ClientReview::where('is_active', true)->latest()->get();

        return view('site.reviews', compact('reviews'));
    }

    public function contact()
    {
        return view('site.contact');
    }

    public function products(Request $request)
    {
        $query = Product::with('subcategory.category')->where('is_active', true);

        // Filter by Category
        if ($request->filled('category')) {
            $query->whereHas('subcategory.category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by Subcategory
        if ($request->filled('subcategory')) {
            $query->whereHas('subcategory', function ($q) use ($request) {
                $q->where('slug', $request->subcategory);
            });
        }

        $products = $query->latest()->paginate(12);

        // Fetch categories specifically for the sidebar filter
        $categories = ProductCategory::with([
            'subcategories' => function ($q) {
                $q->where('is_active', true)->withCount([
                    'products' => function ($q) {
                        $q->where('is_active', true);
                    }
                ]);
            }
        ])->where('is_active', true)->get();

        return view('site.products', compact('products', 'categories'));
    }
}
