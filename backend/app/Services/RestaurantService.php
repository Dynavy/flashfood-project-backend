<?php

namespace App\Services;

use App\Models\Restaurant;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
class RestaurantService
{
    public function store(array $data): Restaurant
    {
        // Validate the Restaurant name and set up personalized validation messages.
        $validator = $this->validateRestaurant($data);

        // Handle validation failures
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return Restaurant::create($validator->validated());
    }

    public function destroy(int $id): array
    {
        $restaurant = Restaurant::findOrFail($id);

        // Store the Restaurant name and address that has been deleted.
        $restaurantName = $restaurant->name;
        $restaurantAddress = $restaurant->address;

        $restaurant->delete();

        return [
            'name' => $restaurantName,
            'address' => $restaurantAddress
        ];
    }

    public function validateRestaurant($data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'google_place_id' => 'required|string|unique:restaurants,google_place_id|max:255',
            'phone' => 'required|string|unique:restaurants,phone|max:15',
            'website' => 'nullable|url|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
            'name.required' => 'The restaurant name is required.',
            'name.string' => 'The restaurant name must be a string.',
            'name.max' => 'The restaurant name should not exceed 100 characters.',

            'address.required' => 'The restaurant address is required.',
            'address.string' => 'The address must be a string.',
            'address.max' => 'The address should not exceed 255 characters.',

            'latitude.required' => 'The latitude is required.',
            'latitude.numeric' => 'The latitude must be a valid number.',
            'latitude.between' => 'The latitude must be between -90 and 90.',

            'longitude.required' => 'The longitude is required.',
            'longitude.numeric' => 'The longitude must be a valid number.',
            'longitude.between' => 'The longitude must be between -180 and 180.',

            'google_place_id.required' => 'The Google Place ID is required.',
            'google_place_id.string' => 'The Google Place ID must be a string.',
            'google_place_id.unique' => 'The Google Place ID must be unique.',
            'google_place_id.max' => 'The Google Place ID should not exceed 255 characters.',

            'phone.required' => 'The phone number is required.',
            'phone.string' => 'The phone number must be a string.',
            'phone.unique' => 'The phone number must be unique.',
            'phone.max' => 'The phone number should not exceed 15 characters.',

            'website.url' => 'The website must be a valid URL.',
            'website.max' => 'The website URL should not exceed 255 characters.',

            'rating.numeric' => 'The rating must be a valid number.',
            'rating.min' => 'The rating must be at least 0.',
            'rating.max' => 'The rating cannot exceed 5.',
        ]);
    }
}