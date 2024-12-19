<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReviewRequest extends FormRequest
{
    // Allow the request to be authorized.
    public function authorize(): bool
    {
        return true;
    }

    // Define validation rules for the request data.
    public function rules(): array
    {
        $rules = [
            'restaurant_id' => 'required|exists:restaurants,id', // Ensure restaurant exists.
            'user_id' => 'required|exists:users,id', // Ensure user exists.
            'comment' => 'required|string|max:500', // Comment must be a string with max length of 500.
            'likes' => 'required|integer|min:0', // Likes must be a non-negative integer.
        ];

        // If the request is a PATCH, make likes and comment optional.
        if ($this->isMethod('patch')) {
            $rules['likes'] = 'nullable|integer|min:0';
            $rules['comment'] = 'nullable|string|max:500';
        }

        return $rules;
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