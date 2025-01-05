<?php

namespace App\Services;

use Illuminate\Support\Facades\Password;

class ResetPasswordService
{
    public function resetPassword(array $data): array
    {
        try {
            $status = Password::reset(
                $data,
                function ($user, string $password) {
                    $user->password = $password;
                    $user->save();
                }
            );

            return [
                'status' => $status === Password::PASSWORD_RESET,
                'message' => $status === Password::PASSWORD_RESET
                    ? 'Password has been reset successfully.'
                    : 'Failed to reset password.'
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Failed to reset password.'
            ];
        }
    }
}
