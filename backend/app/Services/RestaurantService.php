<?php

namespace App\Services;

use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;

class RestaurantService
{
    // Show method on RestaurantController.
    public function showByID($id)
    {
        return Restaurant::findOrFail($id);
    }

    // FindByName method on RestaurantController.
    public function findByName($name)
    {
        return Restaurant::where('name', 'like', '%' . $name . '%')->get();
    }

    // Index method on RestaurantController.
    public function index()
    {
        return Restaurant::query();
    }

    // Store method on RestaurantController.
    public function store(array $data): Restaurant
    {
        return Restaurant::create($data);
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
            DB::rollBack(); // Si ocurre un error, revierte la transacción

            // Puedes registrar el error si lo deseas
            \Log::error('Error al eliminar restaurante: ' . $e->getMessage());

            // Retorna un error 500
            return response()->json(['error' => 'Error al eliminar el restaurante.'], 500);
        }
    }
}


