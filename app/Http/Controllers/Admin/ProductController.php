<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('subcategory.category')->latest()->paginate(10);
        $subcategories = ProductSubcategory::where('is_active', true)->get();
        return view('admin.product-catalog.list', compact('products', 'subcategories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'subcategory_id' => 'required|exists:product_subcategories,id',
                'name' => 'required|string|max:255',
                'slug' => 'nullable|string|unique:products,slug',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:5048',
            ]);

            $data = $request->except('image');
            $data['slug'] = $request->slug ?: Str::slug($request->name);
            $data['is_active'] = $request->has('is_active');
            $data['is_featured'] = $request->has('is_featured');

            if ($request->hasFile('image')) {
                $data['image_path'] = $request->file('image')->store('products', 'public');
            }

            Product::create($data);
            return back()->with('success', 'Product created successfully.');
        } catch (\Exception $e) {

            $error_message = "Message: " . $e->getMessage();

            return redirect()->back()->with('danger', $error_message);
        }

    }

    public function update(Request $request, Product $product)
    {
        try {
            $request->validate([
                'subcategory_id' => 'required|exists:product_subcategories,id',
                'name' => 'required|string|max:255',
                'slug' => 'required|string|unique:products,slug,' . $product->id,
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:5048',
            ]);

            $data = $request->except('image');
            $data['is_active'] = $request->has('is_active');
            $data['is_featured'] = $request->has('is_featured');

            if ($request->hasFile('image')) {
                if ($product->image_path)
                    Storage::disk('public')->delete($product->image_path);
                $data['image_path'] = $request->file('image')->store('products', 'public');
            }

            $product->update($data);
            return back()->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {

            $error_message = "Message: " . $e->getMessage();
            // "File: " . $e->getFile() . "<br>" .
            // "Line: " . $e->getLine() . "<br>";

            return redirect()->back()->with('danger', $error_message);
        }
    }

    public function toggleStatus(Product $product, $field)
    {
        // $field can be 'is_active' or 'is_featured'
        if (in_array($field, ['is_active', 'is_featured'])) {
            $product->$field = !$product->$field;
            $product->save();
            return back()->with('success', 'Status updated.');
        }
        return back()->with('error', 'Invalid action.');
    }

    public function destroy(Product $product)
    {
        if ($product->image_path)
            Storage::disk('public')->delete($product->image_path);
        $product->delete();
        return back()->with('success', 'Product deleted.');
    }
}