<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactMessage;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'subject' => 'required|string|max:100',
            'message' => 'required|string',
            'privacy' => 'required|accepted'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Save to database
            $contactMessage = ContactMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'subject_display' => $this->getSubjectDisplay($request->subject),
                'message' => $request->message,
                'status' => 'new',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            // Send email notification
            Mail::to('ananthaxb@gmail.com')->send(new ContactFormMail($contactMessage));

            return response()->json([
                'success' => true,
                'message' => __('contact.success_message')
            ]);

        } catch (\Exception $e) {
            \Log::error('Contact form submission error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => __('contact.error_message')
            ], 500);
        }
    }

    private function getSubjectDisplay($subject)
    {
        $subjects = [
            'general' => __('contact.subject_general'),
            'service' => __('contact.subject_service'),
            'quote' => __('contact.subject_quote'),
            'partnership' => __('contact.subject_partnership'),
            'other' => __('contact.subject_other')
        ];

        return $subjects[$subject] ?? $subject;
    }

    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.contact-messages', compact('messages'));
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        
        // Mark as read if it's new
        if ($message->status === 'new') {
            $message->update(['status' => 'read']);
        }
        
        return view('admin.contact-message-detail', compact('message'));
    }

    public function updateStatus(Request $request, $id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['status' => $request->status]);
        
        return response()->json(['success' => true]);
    }
}
