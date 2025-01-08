<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Services\Auth\ResetPasswordService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ResetPasswordController extends Controller
{
    public function __construct(private ResetPasswordService $resetPasswordService) {}

    public function showResetForm(Request $request, $token)
    {
        return view('auth.passwords.reset', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $result = $this->resetPasswordService->resetPassword(
            $request->validated()
        );

        return $result
            ? response()->json(['message' => 'Password reset successful.'], 200)
            : response()->json(['error' => 'Failed to reset password.'], 500);
    }
}
