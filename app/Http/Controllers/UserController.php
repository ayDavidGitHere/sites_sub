<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{ 
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email|max:255',
        ]);
        $user = User::create($request->only(['email']));
        return response()->json($user, 201);
    }

    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }
    
    public function show($email)
    {
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        return response()->json($user);
    }
}
