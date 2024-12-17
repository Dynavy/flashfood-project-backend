<?php

namespace App\Services;

use App\Models\Offer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OfferService
{
    // Index method on OfferController.
    public function index()
    {
        return Offer::all();
    }

    // Show method on OfferController.
    public function showByID($id)
    {
        // throw new ModelNotFoundException("test");
        $offer = Offer::findOrFail($id);
        return $offer;
    }

    // FindByName method on OfferController.
    public function findByName($name)
    {
        return Offer::where('name', $name)->firstOrFail();
    }

    // Store method on OfferController.
    public function store(array $data)
    {
        return Offer::create($data);
    }

    // Update method on OfferController.
    public function update($id, array $data)
    {
        $offer = Offer::find($id);
        if (!$offer) {
            throw new ModelNotFoundException("Offer with id $id not found.");
        }

        $oldTitle = $offer->title;
        $offer->update($data);
        
        return [
            'old_title' => $oldTitle,
            'new_title' => $offer->title
        ];
    }

    // Destroy method on OfferController.
    public function destroy($id)
    {
        $offer = Offer::find($id);
        if (!$offer) {
            throw new ModelNotFoundException("Offer with id $id not found.");
        }

        $offerTitle = $offer->title;

        $offer->delete();

        return $offerTitle;
    }
}
