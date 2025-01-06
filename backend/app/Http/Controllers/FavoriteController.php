<?php

namespace App\Http\Controllers;

use App\Services\User\FavoriteService;
use App\Http\Requests\FavoriteRequest;

class FavoriteController extends Controller
{
    // Inject FavoriteService into the controller.
    public function __construct(private FavoriteService $favoriteService) {}

    // Retrieve and return a list of all favorites.
    public function index()
    {
        $favorites = $this->favoriteService->index();
        return response()->json([
            'message' => 'Favorites retrieved successfully!',
            'status' => 'success',
            'data' => $favorites
        ], 200);
    }

    // Retrieve and return a favorite by its ID.
    public function show($id)
    {
        $favorite = $this->favoriteService->showByID($id);
        return response()->json([
            'message' => 'Favorite retrieved successfully!',
            'status' => 'success',
            'data' => $favorite
        ], 200);
    }

    // Create and store a new favorite.
    public function store(FavoriteRequest $request)
    {
        // Delegate creation logic to the service layer.
        $favorite = $this->favoriteService->store($request->validated());
        return response()->json([
            'message' => 'Favorite created successfully!',
            'data' => $favorite,
        ], status: 201);
    }

    // Update a specific favorite by its ID.
    public function update(FavoriteRequest $request, $id)
    {
        $favorite = $this->favoriteService->update($id, $request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'Favorite updated successfully!',
            'data' => $favorite,
        ], status: 200);
    }

    // Delete a specific favorite by its ID.
    public function destroy($id)
    {
        // Delegate deletion logic to the service layer.
        $favorite = $this->favoriteService->destroy($id);

        return response()->json([
            'message' => "Favorite with id $id deleted successfully.",
            'data' => $favorite,
        ], 200);
    }
}
