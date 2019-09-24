<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ContactUs;
use App\Setting;
use App\Mail\ContactUs as ContactUsMail;

class ContactUsController extends Controller
{


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|between:2,180',
            'email' => 'required|email',
            'message' => 'required|string|max:5000'
        ]);
        ContactUs::create($request->all());
        $email = Setting::where('name', 'email')->first()->value;
        // send form to mail
        $mailSend = \Mail::to($email)->send(new ContactUsMail($request->toArray()));

        return response(['status' => true, 'message' => 'Message has been sent successfully.']);
    }
}
