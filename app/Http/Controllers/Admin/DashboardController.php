<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ContactMessage;
use App\Models\User;
use App\Models\ClientReview;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. High-Level Metrics
        $stats = [
            'total_products' => Product::count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
            'total_users' => User::count(),
            'total_reviews' => ClientReview::count(),
        ];

        // 2. Recent Activity (Only grab the 5 most recent for a clean UI)
        $recentMessages = ContactMessage::latest()->take(5)->get();
        $recentProducts = Product::with('subcategory.category')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentMessages', 'recentProducts'));
    }
}