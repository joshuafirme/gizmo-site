<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SystemSettingController extends Controller
{
    public function index()
    {
        // Get the most recent settings, or an empty model if none exist yet
        $settings = SystemSetting::latest()->first() ?? new SystemSetting();
        return view('admin.settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'app_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'version' => 'required|string|max:50',
                'contact_email' => 'nullable|email|max:255',
                'contact_phone' => 'nullable|string|max:255',
                'facebook_url' => 'nullable|url|max:255',
                'twitter_url' => 'nullable|url|max:255',
                'linkedin_url' => 'nullable|url|max:255',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
                'favicon' => 'nullable|mimes:ico,png,jpg|max:1024',
            ]);

            $currentSettings = SystemSetting::latest()->first();
            $data = $request->except(['logo', 'favicon', '_token']);

            // Handle Image Uploads & Retain previous paths if no new image is provided
            if ($request->hasFile('logo')) {
                $data['logo_path'] = $request->file('logo')->store('settings', 'public');
            } else {
                $data['logo_path'] = $currentSettings ? $currentSettings->logo_path : null;
            }

            if ($request->hasFile('favicon')) {
                $data['favicon_path'] = $request->file('favicon')->store('settings', 'public');
            } else {
                $data['favicon_path'] = $currentSettings ? $currentSettings->favicon_path : null;
            }
    
            // Insert a new record to keep historical data intact
            SystemSetting::create($data);

            return back()->with('success', 'System settings updated successfully. Previous version archived.');
        } catch (\Exception $e) {

            $error_message = "Message: " . $e->getMessage();

            return redirect()->back()->with('danger', $error_message);
        }
    }
}