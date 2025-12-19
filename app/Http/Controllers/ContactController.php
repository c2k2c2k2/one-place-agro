<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Store a new contact submission.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|regex:/^[0-9]{10}$/|max:10',
            'message' => 'required|string|max:5000',
        ], [
            'mobile.regex' => 'Please enter a valid 10-digit mobile number.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            ContactSubmission::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'message' => $request->message,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your message! We will get back to you soon.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred. Please try again later.',
            ], 500);
        }
    }
}
