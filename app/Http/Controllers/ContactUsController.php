<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'phone'],
            'message' => ['required', 'string', 'max:1000'],
        ],
            [
                'phone' => 'The :attribute field must be a valid number.',
            ]);

        Mail::to('contact@substrack.com')->send(new ContactMail($validated));

        return back()->with('success', 'Your message has been sent successfully!');
    }
}
