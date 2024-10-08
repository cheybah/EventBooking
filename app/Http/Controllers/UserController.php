<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Get all users
    public function index()
    {
        $users = User::all(); // Retrieve all users from the database

        if ($users->isEmpty()) {
            return response()->json(['message' => 'No users found.'], 404);
        }

        return response()->json($users, 200);
    }

    // Get a specific user by ID
    public function show($id)
    {
        $user = User::find($id); // Find user by ID

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        return response()->json($user, 200);
    }
}
