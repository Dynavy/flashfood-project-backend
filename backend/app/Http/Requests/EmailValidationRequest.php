<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class EmailValidationRequest extends FormRequest
{
    // Allow the request to be authorized.
    public function authorize(): bool
    {
        return true;
    }

    // Define validation rules for the email.
    public function rules()
    {
        return [
            'email' => 'required|string|email|max:255|exists:users,email',
        ];
    }

    // Handle validation failure and return a structured error response.
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'The email format was invalid.',
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}
