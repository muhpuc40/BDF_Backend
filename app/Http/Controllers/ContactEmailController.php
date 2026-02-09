<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactEmail;
use App\Mail\ContactReceived;
use App\Mail\ContactReply;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactEmailController extends Controller
{
    // API endpoint to receive contact form submissions
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            // Store email in database
            $contactEmail = ContactEmail::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'ip_address' => $request->ip(),
                'status' => 'unread',
            ]);

            // Send immediate auto-reply to sender
            Mail::to($request->email)->send(new ContactReceived($contactEmail));

            // Notify admin about new contact
            Mail::to('debate.bangladesh.federation@gmail.com')
                ->send(new \App\Mail\NewContactNotification($contactEmail));

            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully. You will receive a confirmation email shortly.',
                'data' => $contactEmail
            ], 201);

        } catch (\Exception $e) {
            Log::error('Contact email error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to send message. Please try again later.'
            ], 500);
        }
    }

    // Web interface to view emails
    public function index()
    {
        $emails = ContactEmail::latest()->paginate(20);
        return view('emails.index', compact('emails'));
    }

    // Show single email
    public function show($id)
    {
        $email = ContactEmail::findOrFail($id);
        $email->update(['status' => 'read']);
        
        return view('emails.show', compact('email'));
    }

    // Send reply
    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply_message' => 'required|string',
        ]);

        $email = ContactEmail::findOrFail($id);
        
        try {
            // Send reply email
            Mail::to($email->email)->send(new ContactReply($email, $request->reply_message));
            
            // Update email record
            $email->update([
                'status' => 'replied',
                'reply_message' => $request->reply_message,
                'replied_at' => now(),
            ]);

            return redirect()->route('emails.show', $id)
                ->with('success', 'Reply sent successfully!');

        } catch (\Exception $e) {
            Log::error('Reply email error: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Failed to send reply. Please try again.')
                ->withInput();
        }
    }

}