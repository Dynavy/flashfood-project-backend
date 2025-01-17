<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\AuthRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    // Inject the CategoryService into the controller.
    public function __construct(private AuthService $authService)
    {
    }

    public function register(AuthRequest $request): JsonResponse
    {
        // Validate registration data.
        $validatedData = $request->validate($request->registerRules());

        $result = $this->authService->register($validatedData);

        return response()->json([
            'message' => 'User registered successfully.',
            'user' => $result['user'],
            'token' => $result['token'],
        ], 201);
    }

    public function login(AuthRequest $request): JsonResponse
    {
        // Validate login data.
        $validatedData = $request->validate($request->loginRules());

        $result = $this->authService->login($validatedData);

        return response()->json([
            'message' => 'User logged successfully.',
            'user' => $result['user'],
            'token' => $result['token'],
        ], 200);
    }

    public function logout(): JsonResponse
    {
        $this->authService->logout();

        return response()->json([
            'message' => 'User logged out successfully.',
        ], 200);
    }
}