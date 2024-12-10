<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RestaurantService;
use App\Http\Requests\RestaurantRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class RestaurantController extends Controller
{
    // Instance of RestaurantService.
    protected $restaurantService;

    // Inject RestaurantService.
    public function __construct(RestaurantService $restaurantService)
    {
        $this->restaurantService = $restaurantService;
    }

    public function index()
    {
        // Pagination in case the restaurnt list is very large.
        $restaurants = $this->restaurantService->index()->paginate(50);
        return response()->json([
            'message' => 'Restaurants retrieved successfully!',
            'status' => 'success',
            'data' => $restaurants
        ], 200);
    }

    public function show($id)
    {
        $restaurant = $this->restaurantService->showByID($id);
        return response()->json([
            'message' => 'Restaurant retrieved successfully!',
            'status' => 'success',
            'data' => $restaurant
        ], 200);
    }

    public function findByName($name)
    {

        $restaurantName = $this->restaurantService->findByName($name);

        if ($restaurantName->isEmpty()) {
            return response()->json([
                'message' => 'No restaurant found with that name.',
                'status' => 'error',
                'data' => []
            ], 404);
        }

        return response()->json([
            'message' => 'Restaurant retrieved successfully!',
            'status' => 'success',
            'data' => $restaurantName
        ], 200);
    }

    // Create a specific category (create).
    public function store(RestaurantRequest $request)
    {
        try {
            // Delegate the creation logic to the service layer.
            $restaurant = $this->restaurantService->store($request->validated());
            return response()->json([
                'message' => 'Category created successfully!',
                'category' => $restaurant,
            ], status: 201);

        } catch (\Exception $e) {
            // Handle any other exceptions
            return response()->json([
                'message' => 'An error occurred while creating the category.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    // Update a specific restaurant (update).
    public function update(RestaurantRequest $request, $id)
    {
        $restaurant = $this->restaurantService->update($id, $request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Restaurant updated successfully!',
            'data' => $restaurant,
        ], status: 200);
    }

    // Delete a specific resource (destroy).
    public function destroy($id)
    {
        // Delegate the deletion logic to the service layer.
        $restaurantName = $this->restaurantService->destroy($id);

        return response()->json([
            'message' => "Category $restaurantName with id $id deleted successfully."
        ], 200);
    }
}
