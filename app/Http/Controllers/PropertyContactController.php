<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Mail;

class PropertyContactController extends Controller
{
    public function sendMessage(Request $request, Property $property)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|max:1000',
        ]);

        // Check if property has an owner with an email
        if (!$property->owner || !$property->owner->email) {
            return back()->with('error', 'The property owner does not have an email set up.');
        }

        // Send Email to Owner
        Mail::send('emails.property_contact', ['request' => $request, 'property' => $property], function ($mail) use ($property, $request) {
            $mail->to($property->owner->email)
                 ->subject('New Inquiry About Your Property - ' . $property->title)
                 ->replyTo($request->email);
        });

        return back()->with('success', 'Your message has been sent to the owner.');
    }
}

