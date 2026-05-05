<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
/**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch categories, latest first, 10 per page
        $categories = ProductCategory::latest()->paginate(10);
        
        return view('admin.product-catalog.categories', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:product_categories,slug',
            'description' => 'nullable|string',
        ]);

        // 2. Generate slug if not provided, and format it properly
        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);

        // 3. Fallback to ensure slug uniqueness if it was auto-generated
        if (ProductCategory::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . time();
        }

        // 4. Create the record
        ProductCategory::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'icon_class' => $request->icon_class,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCategory $category)
    {
        // 1. Validate, ignoring the current category's ID for the slug uniqueness check
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:product_categories,slug,' . $category->id,
            'description' => 'nullable|string',
        ]);

        // 2. Update the record
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'description' => $request->description,
            'icon_class' => $request->icon_class
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $category)
    {
        // Note: Because we set up 'onDelete("cascade")' in the migration, 
        // deleting this category will automatically delete its subcategories.
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    /**
     * Custom method to toggle the is_active status.
     */
    public function toggleStatus(ProductCategory $category)
    {
        // Flip the boolean value
        $category->is_active = !$category->is_active;
        $category->save();

        // Dynamic success message based on the new state
        $statusWord = $category->is_active ? 'enabled' : 'disabled';

        return redirect()->back()
            ->with('success', "Category has been {$statusWord} successfully.");
    }
}
