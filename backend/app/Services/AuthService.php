<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function register(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        return $user;
    }


    public function login(array $credentials): array
    {

        // Throws authentication exception if the user its invalid.
        if (!Auth::attempt($credentials)) {
            throw new \Exception('Invalid credentials.', 401);
        }

        // Get the user data if authenticated.
        $user = Auth::user();

        // Generates personal token for the user trought Sanctum.
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}
