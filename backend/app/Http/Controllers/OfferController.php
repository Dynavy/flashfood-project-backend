<?php

namespace App\Http\Controllers;

use App\Services\OfferService;
use App\Http\Requests\OfferRequest;


class OfferController extends Controller
{
    protected $offerService;

    // Inject CategoryService.
    public function __construct(OfferService $offerService)
    {
        $this->offerService = $offerService;
    }

    public function index()
    {
        $offers = $this->offerService->index();
        return response()->json([
            'message' => 'Offers retrieved successfully!',
            'status' => 'success',
            'data' => $offers,
        ], 200);
    }

    public function show($id)
    {
        $offer = $this->offerService->showByID($id);

        return response()->json([
            'message' => 'Offer retrieved successfully!',
            'status' => 'success',
            'data' => $offer,
        ], 200);
    }

    public function findByName($name)
    {

        $offerName = $this->offerService->findByName($name);

        if ($offerName->isEmpty()) {
            return response()->json([
                'message' => 'No offer found with that name.',
                'status' => 'error',
                'data' => []
            ], 404);
        }

        return response()->json([
            'message' => 'Offer retrieved successfully!',
            'status' => 'success',
            'data' => $offerName
        ], 200);
    }

    // Create a specific category (create).
    public function store(OfferRequest $request)
    {
        // Delegate the creation logic to the service layer.
        $offer = $this->offerService->store($request->validated());

        return response()->json([
            'message' => 'Offer created successfully!',
            'offer' => $offer,
        ], 201);
    }

    // Update a specific category (update).
    public function update(OfferRequest $request, int $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $nameChange = $this->offerService->update($id, $validatedData);

        return response()->json([
            'message' => "The offer has been successfully updated from '{$nameChange['old_name']}' to '{$nameChange['new_name']}'."
        ], 200);
    }

    // Delete a specific resource (destroy).
    public function destroy($id)
    {
        // Delegate the deletion logic to the service layer.
        $offerName = $this->offerService->destroy($id);

        return response()->json([
            'message' => "Offer $offerName with id $id deleted successfully."
        ], 200);
    }
}