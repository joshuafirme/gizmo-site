<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // We'll map the "Company Name" input to the "subject" database column
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
            'g-recaptcha-response' => 'required|string'
        ]);

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip()
        ]);

        $recaptchaData = $response->json();

        // Check if verification was successful and the trust score is >= 0.5 (1.0 is a perfect human)
        if (!isset($recaptchaData['success']) || !$recaptchaData['success'] || $recaptchaData['score'] < 0.5) {
            return back()->withErrors(['captcha' => 'Spam protection check failed. Please try again.'])->withInput();
        }

        ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'is_read' => false,
        ]);

        // Redirect back to the exact section (#contact) on the landing page
        return redirect(url()->previous() . '#contact')->with('success', 'Inquiry Sent! A representative will contact you shortly.');
    }
}