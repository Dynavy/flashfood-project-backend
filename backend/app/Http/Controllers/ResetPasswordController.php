<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Services\ResetPasswordService;
use Illuminate\Http\JsonResponse;

class ResetPasswordController extends Controller
{
    public function __construct(private ResetPasswordService $resetPasswordService) {}

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $result = $this->resetPasswordService->resetPassword(
            $request->validated()  // This will return all validated fields
        );

        return $result
            ? response()->json(['message' => 'Password reset successful.'], 200)
            : response()->json(['error' => 'Failed to reset password.'], 500);
    }
}
