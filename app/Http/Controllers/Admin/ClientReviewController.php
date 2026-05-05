<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientReviewController extends Controller
{
    public function index()
    {
        $reviews = ClientReview::latest()->paginate(10);
        return view('admin.client-reviews.list', compact('reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'position_company' => 'required|string|max:255',
            'review_text' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
        ]);

        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('clients', 'public');
        }

        ClientReview::create($data);
        return back()->with('success', 'Review added successfully.');
    }

    public function update(Request $request, ClientReview $review)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'position_company' => 'required|string|max:255',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($review->image_path)
                Storage::disk('public')->delete($review->image_path);
            $data['image_path'] = $request->file('image')->store('clients', 'public');
        }

        $review->update($data);
        return back()->with('success', 'Review updated successfully.');
    }

    public function destroy(ClientReview $review)
    {
        if ($review->image_path)
            Storage::disk('public')->delete($review->image_path);
        $review->delete();
        return back()->with('success', 'Review removed.');
    }
}