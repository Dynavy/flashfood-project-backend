<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailValidationRequest;
use App\Services\Auth\ForgotPasswordService;


class ForgotPasswordController extends Controller
{
    // Inject the ForgotPasswordService into the controller
    public function __construct(private ForgotPasswordService $forgotPasswordService) {}

    public function sendResetLink(EmailValidationRequest $request)
    {

        $response = $this->forgotPasswordService->sendResetLink($request->validated()['email']);

        return $response['status']
            ? response()->json(['message' => $response['message']], 200)
            : response()->json(['error' => $response['message']], 500);
    }
}
