<?php

namespace App\Services;

use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RestaurantService
{
    // Index method on RestaurantController.
    public function index()
    {
        return Restaurant::query();
    }

    // Show method on RestaurantController.
    public function showByID($id)
    {
        // throw new ModelNotFoundException("test");
        $restaurant = Restaurant::findOrFail($id);
        return $restaurant;
    }

    // FindByName method on RestaurantController.
    public function findByName($name)
    {
        return Restaurant::where('name', $name)->firstOrFail();
    }

    // Store method on RestaurantController.
    public function store(array $data): Restaurant
    {
        return Restaurant::create($data);
    }

    public function update(int $id, array $data): Restaurant
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->update($data);
        return $restaurant;
    }

    // Destroy method on RestaurantController.
    public function destroy(int $id): string
    {
        try {
            DB::beginTransaction();
            $restaurant = Restaurant::findOrFail($id);
            $restaurantName = $restaurant->name;
            $restaurant->delete();

            DB::commit();
            return $restaurantName;

        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Error when deleting a restaurant: ' . $e->getMessage());

            return response()->json(['error' => 'Error deleting the restaurant.'], 500);
        }
    }
}


