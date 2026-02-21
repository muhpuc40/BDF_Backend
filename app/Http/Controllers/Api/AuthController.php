<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return response()->json([
                'message' => 'No account found with this email.'
            ], 404);
        }

        if ($user->status === 'pending') {
            return response()->json([
                'message' => 'Your account is pending approval.'
            ], 403);
        }

        if ($user->status === 'rejected') {
            return response()->json([
                'message' => 'Your account has been rejected.'
            ], 403);
        }

        if ($user->status === 'banned') {
            return response()->json([
                'message' => 'Your account has been banned.'
            ], 403);
        }

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Invalid email or password.'
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'message' => 'Could not create token. ' . $e->getMessage()
            ], 500);
        }

        return response()->json([
            'token' => $token,
            'user'  => [
                'id'          => $user->id,
                'full_name'   => $user->full_name,
                'email'       => $user->email,
                'role'        => $user->role ?? 'user',
                'status'      => $user->status,
                'phone'       => $user->phone,
                'institution' => $user->institution,
            ],
        ], 200);
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
        } catch (JWTException $e) {
            // already invalid, ignore
        }

        return response()->json([
            'message' => 'Logged out successfully.'
        ], 200);
    }

    public function me()
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return response()->json(['message' => 'User not found.'], 404);
            }

            return response()->json([
                'id'          => $user->id,
                'full_name'   => $user->full_name,
                'email'       => $user->email,
                'role'        => $user->role ?? 'user',
                'status'      => $user->status,
                'phone'       => $user->phone,
                'institution' => $user->institution,
            ], 200);

        } catch (JWTException $e) {
            return response()->json([
                'message' => 'Token invalid or expired.'
            ], 401);
        }
    }
}