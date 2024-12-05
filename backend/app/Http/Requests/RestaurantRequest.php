<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'google_place_id' => 'required|string|unique:restaurants,google_place_id|max:255',
            'phone' => 'required|string|unique:restaurants,phone|max:15',
            'website' => ['nullable', 'regex:/^https:\/\/.+$/', 'max:255'],
            'rating' => 'nullable|numeric|min:0|max:5',
        ];
    }
}

