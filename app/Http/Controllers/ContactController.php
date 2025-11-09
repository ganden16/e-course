<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactCompanyMail;
use App\Mail\ContactUserMail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Handle the contact form submission
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Prepare the data
        $contactData = [
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'submitted_at' => now()->format('Y-m-d H:i:s'),
        ];

        try {
            // Mail::to(env('CONTACT_COMPANY_EMAIL'))->send(new ContactCompanyMail($contactData));
            Mail::to($contactData['email'])->send(new ContactUserMail($contactData));
        } catch (\Exception $e) {
            Log::error('Failed to send confirmation email to user: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Failed to send your message. Please try again later. Error : ' . $e->getMessage())
                ->withInput();
        }

        return redirect()
            ->back()
            ->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}
