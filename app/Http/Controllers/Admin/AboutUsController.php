<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $entries = AboutUs::latest()->get();
        return view('admin.sections.about-us', compact('entries'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'section_title' => 'required|string|max:255',
                'mission' => 'required|string',
                'vision' => 'required|string',
                'values' => 'nullable|array',
            ]);

            AboutUs::create([
                'section_title' => $request->section_title,
                'is_active' => $request->has('is_active'),
                'json_content' => [
                    'mission' => $request->mission,
                    'vision' => $request->vision,
                    'values' => array_filter($request->values ?? []),
                ]
            ]);

            return back()->with('success', 'About Us section created.');
        } catch (\Exception $e) {

            $error_message = "Message: " . $e->getMessage();

            return redirect()->back()->with('danger', $error_message);
        }
    }

    public function update(Request $request, AboutUs $aboutUs)
    {
        try {
            $request->validate([
                'section_title' => 'required|string|max:255',
                'mission' => 'required|string',
                'vision' => 'required|string',
            ]);

            $aboutUs->update([
                'section_title' => $request->section_title,
                'is_active' => $request->has('is_active'),
                'json_content' => [
                    'mission' => $request->mission,
                    'vision' => $request->vision,
                    'values' => array_filter($request->values ?? []),
                ]
            ]);

            return back()->with('success', 'About Us section updated.');
        } catch (\Exception $e) {

            $error_message = "Message: " . $e->getMessage();

            return redirect()->back()->with('danger', $error_message);
        }
    }

    public function destroy(AboutUs $aboutUs)
    {
        $aboutUs->delete();
        return back()->with('success', 'Entry deleted.');
    }
}