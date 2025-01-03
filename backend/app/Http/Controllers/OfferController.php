<?php

namespace App\Http\Controllers;

use App\Services\OfferService;
use App\Http\Requests\OfferRequest;

class OfferController extends Controller
{
    // Inject the OfferService into the controller.
    public function __construct(private OfferService $offerService) {}

    // Retrieve and return a list of all offers.
    public function index()
    {
        $offers = $this->offerService->index();
        return response()->json([
            'message' => 'Offers retrieved successfully!',
            'status' => 'success',
            'data' => $offers,
        ], 200);
    }

    // Retrieve and return an offer by its ID.
    public function show($id)
    {
        $offer = $this->offerService->showByID($id);

        return response()->json([
            'message' => 'Offer retrieved successfully!',
            'status' => 'success',
            'data' => $offer,
        ], 200);
    }

    // Find and return an offer by its name.
    public function findByName($name)
    {
        $offerName = $this->offerService->findByName($name);

        return response()->json([
            'message' => 'Offer retrieved successfully!',
            'status' => 'success',
            'data' => $offerName
        ], 200);
    }

    // Create a new offer and return the created offer.
    public function store(OfferRequest $request)
    {
        // Delegate the creation logic to the service layer.
        $offer = $this->offerService->store($request->validated());

        return response()->json([
            'message' => 'Offer created successfully!',
            'offer' => $offer,
        ], 201);
    }

    // Update an existing offer and return the updated information.
    public function update(OfferRequest $request, int $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $nameChange = $this->offerService->update($id, $validatedData);

        return response()->json([
            'message' => "The offer has been successfully updated."
        ], 200);
    }

    // Delete an offer by its ID.
    public function destroy($id)
    {
        // Delegate the deletion logic to the service layer.
        $offerName = $this->offerService->destroy($id);

        return response()->json([
            'message' => "Offer $offerName with id $id deleted successfully."
        ], 200);
    }
}
