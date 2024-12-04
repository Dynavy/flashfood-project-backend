<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RestaurantService;
use App\Http\Requests\RestaurantRequest;

class RestaurantController extends Controller
{
    // Instance of RestaurantService.
    protected $restaurantService;

    // Inject RestaurantService.
    public function __construct(RestaurantService $restaurantService)
    {
        $this->restaurantService = $restaurantService;
    }

    public function show(RestaurantRequest $request, $id)
    {
        $restaurant = $this->restaurantService->showByID($id);
        return response()->json($restaurant);
    }

    public function findByName(RestaurantRequest $request, $name)
    {
        $restaurantName = $this->restaurantService->findByName($name);
        return response()->json($restaurantName);
    }

    public function index()
    {
        // Pagination in case the restaurnt list is very large.
        $restaurants = $this->restaurantService->index()->paginate(50);
        return response()->json($restaurants);
    }

    // Create a specific category (create).
    public function store(RestaurantRequest $request)
    {
        // Delegate the creation logic to the service layer.
        $restaurant = $this->restaurantService->store($request->all());

        return response()->json([
            'message' => 'Restaurant created successfully!',
            'restaurant' => $restaurant,
        ], 201);
    }


    // Update a specific category (update).
    public function update(Request $request, $id)
    {
        // Empty method
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
