<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistrationReceived;
use App\Mail\NewUserNotification;

class UserController extends Controller
{
    // Register new user
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'institution' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Create user
            $user = User::create([
                'full_name' => $request->fullName,
                'email' => $request->email,
                'phone' => $request->phone,
                'institution' => $request->institution,
                'password' => Hash::make($request->password),
                'status' => 'pending'
            ]);

            // Send confirmation email to user
            Mail::to($user->email)->send(new UserRegistrationReceived($user));

            // Notify admin about new registration
            Mail::to('debate.bangladesh.federation@gmail.com')
                ->send(new NewUserNotification($user));

            return response()->json([
                'success' => true,
                'message' => 'Registration successful! Please wait for admin approval.',
                'data' => $user
            ], 201);

        } catch (\Exception $e) {
            \Log::error('Registration error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Registration failed. Please try again.'
            ], 500);
        }
    }



 
}