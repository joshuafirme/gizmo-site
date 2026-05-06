<?php

namespace App\Http\Controllers;

use App\Mail\NewContactMessage;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {

        try {
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

            $message = ContactMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'is_read' => false,
            ]);

            $recipientEmail = app('settings')->contact_email; // Fetch email from global settings

            if (!empty($recipientEmail)) {
                try {
                    // Using Mail::send() directly. You can use Mail::queue() if you have queue workers configured
                    Mail::to($recipientEmail)->send(new NewContactMessage($message));
                } catch (\Exception $e) {

                    $error_message = "Message: " . $e->getMessage();

                    return redirect()->back()->with('danger', $error_message);
                }
            }

            // Redirect back to the exact section (#contact) on the landing page
            return redirect(url()->previous() . '#contact')->with('success', 'Inquiry Sent! A representative will contact you shortly.');
        } catch (\Exception $e) {

            $error_message = "Message: " . $e->getMessage();

            return redirect()->back()->with('danger', $error_message);
        }
    }
}