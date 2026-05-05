<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhoWeAre;
use Illuminate\Http\Request;

class WhoWeAreController extends Controller
{
    public function index()
    {
        $sections = WhoWeAre::latest()->get();
        return view('admin.sections.who-we-are', compact('sections'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'heading' => 'required|string|max:255',
                'main_content' => 'required|string',
            ]);

            $data = $request->all();
            // Convert bullet points to JSON array
            $data['bullet_points'] = $request->bullet_points ? array_filter($request->bullet_points) : [];
            $data['is_active'] = $request->has('is_active');

            WhoWeAre::create($data);
            return back()->with('success', 'About section created.');
        } catch (\Exception $e) {

            $error_message = "Message: " . $e->getMessage();

            return redirect()->back()->with('danger', $error_message);
        }
    }

    public function update(Request $request, WhoWeAre $about)
    {
        try {
            $request->validate([
                'heading' => 'required|string|max:255',
                'main_content' => 'required|string',
            ]);

            $data = $request->all();
            $data['bullet_points'] = $request->bullet_points ? array_filter($request->bullet_points) : [];
            $data['is_active'] = $request->has('is_active');

            $about->update($data);
            return back()->with('success', 'About section updated.');
        } catch (\Exception $e) {

            $error_message = "Message: " . $e->getMessage();

            return redirect()->back()->with('danger', $error_message);
        }
    }

    public function destroy(WhoWeAre $about)
    {
        $about->delete();
        return back()->with('success', 'Section deleted.');
    }
}