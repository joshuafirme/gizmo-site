<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeroSlider;
use App\Models\WhoWeAre;
use App\Models\AboutUs;
use App\Models\Product;
use App\Models\ClientReview;
use App\Models\SystemSetting;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = HeroSlider::where('is_active', true)->orderBy('display_order')->get();
        $whoWeAre = WhoWeAre::where('is_active', true)->latest()->first();
        $aboutUs = AboutUs::where('is_active', true)->latest()->first();
        $featuredProducts = Product::with('subcategory')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->take(6)
            ->get();
        $reviews = ClientReview::where('is_active', true)->latest()->get();
        $settings = SystemSetting::latest()->first() ?? new SystemSetting();

        return view('site.home', compact(
            'sliders',
            'whoWeAre',
            'aboutUs',
            'featuredProducts',
            'reviews',
            'settings'
        ));
    }
}
