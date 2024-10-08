<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\User;

class LoginController extends Controller
{
    // Login logic for both client and admin
    public function login(Request $request)
    {
        try {
            // Validate the incoming request
            $validateUser = Validator::make($request->all(), [
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            // Check if user exists and password is correct
            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid login details',
                ], 401);
            }

            $user = User::where('email', $request->email)->firstOrFail();

            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                'user' => $user, // Include the user data in the response
                'role' => $user->role, // Pass the role to frontend
            ], 200);

        }catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Login failed'
            ], 500);
        }
    }
}

