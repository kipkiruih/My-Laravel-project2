<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;


class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Send email (optional)
        Mail::to('kipkiruiken02@gmail.com')->send(new ContactMail($request->all()));

        return back()->with('success', 'Your message has been sent successfully!');
    }
}

