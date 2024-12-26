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
        $user = $this->authService->register($request->validated());

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'user' => $user,
        ], 201);
    }
}
