<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductSubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = ProductSubcategory::with('category')->latest()->paginate(10);
        $categories = ProductCategory::where('is_active', true)->get();
        return view('admin.product-catalog.subcategories', compact('subcategories', 'categories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'category_id' => 'required|exists:product_categories,id',
                'name' => 'required|string|max:255',
                'slug' => 'nullable|string|unique:product_subcategories,slug',
            ]);

            ProductSubcategory::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'slug' => $request->slug ?: Str::slug($request->name),
                'description' => $request->description,
                'is_active' => $request->has('is_active')
            ]);

            return back()->with('success', 'Subcategory created successfully.');
        } catch (\Exception $e) {

            $error_message = "Message: " . $e->getMessage();

            return redirect()->back()->with('danger', $error_message);
        }
    }

    public function update(Request $request, ProductSubcategory $subcategory)
    {
        try {
            $request->validate([
                'category_id' => 'required|exists:product_categories,id',
                'name' => 'required|string|max:255',
                'slug' => 'required|string|unique:product_subcategories,slug,' . $subcategory->id,
            ]);

            $subcategory->update([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
                'is_active' => $request->has('is_active')
            ]);

            return back()->with('success', 'Subcategory updated successfully.');
        } catch (\Exception $e) {

            $error_message = "Message: " . $e->getMessage();

            return redirect()->back()->with('danger', $error_message);
        }
    }

    public function destroy(ProductSubcategory $subcategory)
    {
        $subcategory->delete();
        return back()->with('success', 'Subcategory deleted successfully.');
    }

    public function toggleStatus(ProductSubcategory $subcategory)
    {
        $subcategory->is_active = !$subcategory->is_active;
        $subcategory->save();
        return back()->with('success', 'Status updated successfully.');
    }
}