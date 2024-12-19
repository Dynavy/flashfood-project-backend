<?php

namespace App\Services;

use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RestaurantService
{
    /**
     * Retrieve all restaurants.
     *
     * This method retrieves all the restaurants from the database and returns the query builder for further customization if needed.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function index()
    {
        return Restaurant::query();
    }

    /**
     * Retrieve a specific restaurant by its ID.
     *
     * This method fetches a restaurant by its ID from the database. 
     * If the restaurant doesn't exist, it throws a ModelNotFoundException.
     *
     * @param int $id
     * @return Restaurant
     * @throws ModelNotFoundException
     */
    public function showByID($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return $restaurant;
    }

    /**
     * Find a restaurant by its name.
     *
     * This method searches for a restaurant using the 'name' attribute. 
     * If no restaurant is found, it throws a ModelNotFoundException.
     *
     * @param string $name
     * @return Restaurant
     * @throws ModelNotFoundException
     */
    public function findByName($name)
    {
        return Restaurant::where('name', $name)->firstOrFail();
    }

    /**
     * Store a new restaurant in the database.
     *
     * This method creates and stores a new restaurant using the provided data.
     *
     * @param array $data
     * @return Restaurant
     */
    public function store(array $data): Restaurant
    {
        return Restaurant::create($data);
    }

    /**
     * Update an existing restaurant by its ID.
     *
     * This method finds a restaurant by its ID and updates it with the provided data.
     *
     * @param int $id
     * @param array $data
     * @return Restaurant
     * @throws ModelNotFoundException
     */
    public function update(int $id, array $data): Restaurant
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->update($data);
        return $restaurant;
    }

    /**
     * Delete a restaurant by its ID.
     *
     * This method deletes a restaurant and returns its name before deletion. 
     * It uses database transactions to ensure the operation is atomic.
     * If the operation fails, it rolls back the transaction.
     *
     * @param int $id
     * @return string
     * @throws \Exception
     */
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
            throw $e;
        }
    }
}