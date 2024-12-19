<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class OfferRequest extends FormRequest
{
    // Allow the request to be authorized.
    public function authorize(): bool
    {
        return true;
    }

    // Define validation rules for the request data.
    public function rules(): array
    {
        return [
            'restaurant_id' => 'required|exists:restaurants,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'popularity' => 'nullable|integer|min:0',
            'status' => 'required|in:active,expired',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:valid_from',
        ];
    }

    // Handle validation failure and return a structured error response.
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}