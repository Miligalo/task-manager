<?php

declare(strict_types=1);

namespace App\Http\Service\Auth;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function register(array $data): string
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->createToken('auth_token')->plainTextToken;

        return $user->createToken('auth_token')->plainTextToken;
    }

    public function login(array $data): string
    {
        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            throw new \Exception('Invalid login details');
        }

        $user = User::where('email', $data['email'])->firstOrFail();

        return $user->createToken('auth_token')->plainTextToken;
    }

    public function logout(): JsonResponse
    {
        Auth::user()->tokens()->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
