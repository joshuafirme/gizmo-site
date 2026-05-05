<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSliderController extends Controller
{
    public function index()
    {
        $sliders = HeroSlider::orderBy('display_order')->get();
        return view('admin.hero-sliders.list', compact('sliders'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title_badge' => 'required|string|max:255',
                'heading' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,webp,avif|max:3072',
                'display_order' => 'required|integer',
            ]);

            $data = $request->except('image');
            $data['is_active'] = $request->has('is_active');

            if ($request->hasFile('image')) {
                $data['image_path'] = $request->file('image')->store('sliders', 'public');
            }

            HeroSlider::create($data);
            return back()->with('success', 'Slider added successfully.');

        } catch (\Exception $e) {

            $error_message = "Message: " . $e->getMessage();

            return redirect()->back()->with('danger', $error_message);
        }
    }

    public function update(Request $request, HeroSlider $slider)
    {
        try {
            $request->validate([
                'title_badge' => 'required|string|max:255',
                'heading' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:3072',
            ]);

            $data = $request->except('image');
            $data['is_active'] = $request->has('is_active');

            if ($request->hasFile('image')) {
                if ($slider->image_path)
                    Storage::disk('public')->delete($slider->image_path);
                $data['image_path'] = $request->file('image')->store('sliders', 'public');
            }

            $slider->update($data);
            return back()->with('success', 'Slider updated successfully.');

        } catch (\Exception $e) {

            $error_message = "Message: " . $e->getMessage();

            return redirect()->back()->with('danger', $error_message);
        }
    }

    public function destroy(HeroSlider $slider)
    {
        if ($slider->image_path)
            Storage::disk('public')->delete($slider->image_path);
        $slider->delete();
        return back()->with('success', 'Slider deleted successfully.');
    }

    public function toggleStatus(HeroSlider $slider)
    {
        $slider->is_active = !$slider->is_active;
        $slider->save();
        return back()->with('success', 'Status updated.');
    }
}