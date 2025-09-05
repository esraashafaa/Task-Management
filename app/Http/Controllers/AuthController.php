<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'confirmed']
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password']
        ]);

        $token = $user->createToken("api token")->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        auth()->attempt([
            'email' => $validated['email'],
            'password' => $validated['password']
        ]);

        $user = auth()->user();

        $token = $user->createToken('afaef')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function me()
    {
        return auth()->user();
    }
}
