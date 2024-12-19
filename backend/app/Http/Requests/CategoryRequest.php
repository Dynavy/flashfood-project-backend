<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CategoryRequest extends FormRequest
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
            'name' => 'required|string|max:50|unique:categories,name',
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