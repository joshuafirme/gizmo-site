<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return ContactMessage::latest()->get();
    }

    public function markAsRead($id)
    {
        $msg = ContactMessage::findOrFail($id);
        $msg->is_read = true;
        $msg->save();

        return response()->json(['message' => 'Marked as read']);
    }

    public function destroy($id)
    {
        ContactMessage::findOrFail($id)->delete();

        return response()->json(['message' => 'Deleted']);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string'
        ]);

        ContactMessage::create($request->all());

        return response()->json([
            'message' => 'Message sent successfully!'
        ]);
    }
}
