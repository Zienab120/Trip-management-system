<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function __invoke(ContactRequest $request)
    {
        $contact = Contact::create($request->validated());
        return response()->json([
            'contact' => $contact,
            'message' => 'This contact is created successfully.'
        ], 201);
    }
}
