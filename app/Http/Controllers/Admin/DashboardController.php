<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $productCount = Product::count();
        // $reviewCount = ClientReview::where('is_active', true)->count();
        // $recentProducts = Product::with('subcategory')->latest()->take(5)->get();

        return view('admin.dashboard', compact('productCount', 'reviewCount', 'recentProducts'));
    }
}