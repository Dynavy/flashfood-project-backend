<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(AuthRequest $request): JsonResponse
    {
        $validatedData = $request->validate($request->registerRules());

        $user = $this->authService->register($validatedData);
        return response()->json([
            'message' => 'User registered successfully.',
            'user' => $user,
        ], 201);
    }

    public function login(AuthRequest $request): JsonResponse
    {
        $validatedData = $request->validate($request->loginRules());

        $user = $this->authService->login($validatedData);

        return response()->json([
            'message' => 'User logged successfully.',
            'user' => $user,
        ], 201);
    }
}
