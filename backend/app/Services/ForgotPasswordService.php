<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

class ForgotPasswordService
{
    public function sendResetLink(string $email): array
    {
        try {
            $status = Password::sendResetLink(['email' => $email]);

            return [
                'status' => $status === Password::RESET_LINK_SENT,
                'message' => __($status)
            ];
        } catch (\Exception $e) {
            Log::error('Error sending reset password email: ' . $e->getMessage(), [
                'email' => $email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'status' => false,
                'message' => 'Error sending the recuperation email.',
                'debug' => config('app.debug') ? $e->getMessage() : null
            ];
        }
    }
}
