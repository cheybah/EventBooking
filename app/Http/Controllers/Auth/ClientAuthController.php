<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientAuthController extends Controller
{
    // Register a new client
    public function register(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', // Unique to prevent duplicate email
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new client (role CLIENT by default)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'CLIENT', // Assign CLIENT role
        ]);

        return response()->json(['message' => 'Client registered successfully'], 201);
    }
}

