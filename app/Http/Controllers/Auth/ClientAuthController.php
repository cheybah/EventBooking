<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ClientAuthController extends Controller
{
    // Register a new client
    public function register(Request $request)
    {
        try {
            Log::info($request->all());

            // Validate the incoming request
            $validateUser = Validator::make($request->all(),
                [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users', // Unique to prevent duplicate email
                'password' => 'required',
            ]);

            if($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            // Create a new client (role CLIENT by default)
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'CLIENT', // Assign CLIENT role
            ]);

            Log::info('User created: ', $user->toArray());

            return response()->json([
                'status' => true,
                'message' => 'User created successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 201);

        } catch (\Exception $e) {

            Log::error('Registration error: ' . $e->getMessage());
            return response()->json(['message' => 'User registration failed'], 500);
        }
    }
}

