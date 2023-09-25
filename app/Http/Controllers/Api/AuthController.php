<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid email or password'], 401);
        }

        $token = Auth::user()->createToken('my-app-token')->plainTextToken;
        $cookie = cookie('jwt', $token, 60 * 24);  // 1 day

        return response()->json(['message' => 'Successfully logged in'])
            ->withCookie($cookie);
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        $token = $user->createToken('my-app-token')->plainTextToken;
        $cookie = cookie('jwt', $token, 60 * 24);  // 1 day

        return response()->json(['message' => 'User successfully registered'], 201)
            ->withCookie($cookie);
    }
}
