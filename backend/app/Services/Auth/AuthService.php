<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\AuthenticationException;

class AuthService
{
    public function register(array $data): array
    {
        // Creates the user in the database.
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        Mail::to($user->email)->send(new WelcomeEmail($user));

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function login(array $credentials): array
    {

        // Throws authentication exception if the user its invalid.
        if (!Auth::attempt($credentials)) {
            throw new AuthenticationException();
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

    public function logout(): void
    {
        // Deletes the actual token of the authenthicated user.
        Auth::user()->currentAccessToken();
    }
}