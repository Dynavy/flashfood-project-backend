<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RestaurantRequest extends FormRequest
{
    // Allow the request to be authorized.
    public function authorize()
    {
        return true;
    }

    // Define validation rules for the request data.
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'google_place_id' => 'required|string|unique:restaurants,google_place_id|max:255',
            'phone' => 'required|string|unique:restaurants,phone|max:15',
            'website' => ['nullable', 'regex:/^https:\/\/.+$/', 'max:255'],
            'rating' => 'nullable|numeric|min:0|max:5',
        ];

        // If the request is a PATCH, make some fields optional.
        if ($this->isMethod('patch')) {
            $rules['address'] = 'nullable|string|max:255';
            $rules['latitude'] = 'nullable|numeric';
            $rules['longitude'] = 'nullable|numeric';
            $rules['google_place_id'] = 'nullable|string';
            $rules['phone'] = 'nullable|string|max:15';
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