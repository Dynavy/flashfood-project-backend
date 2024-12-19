<?php

namespace App\Services;

use App\Models\Offer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OfferService
{
    /**
     * Retrieve all offers.
     *
     * This method retrieves all the offers from the database and returns them.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Offer::all();
    }

    /**
     * Retrieve a specific offer by its ID.
     *
     * This method fetches an offer by its ID from the database. 
     * If the offer doesn't exist, it throws a ModelNotFoundException.
     *
     * @param int $id
     * @return Offer
     * @throws ModelNotFoundException
     */
    public function showByID($id)
    {
        $offer = Offer::findOrFail($id);
        return $offer;
    }

    /**
     * Find an offer by its name.
     *
     * This method searches for an offer using the 'name' attribute. 
     * If no offer is found, it throws a ModelNotFoundException.
     *
     * @param string $name
     * @return Offer
     * @throws ModelNotFoundException
     */
    public function findByName($name)
    {
        return Offer::where('name', $name)->firstOrFail();
    }

    /**
     * Store a new offer in the database.
     *
     * This method creates and stores a new offer using the provided data.
     *
     * @param array $data
     * @return Offer
     */
    public function store(array $data)
    {
        return Offer::create($data);
    }

    /**
     * Update an existing offer by its ID.
     *
     * This method finds an offer by its ID and updates it with the provided data. 
     * It returns both the old and new names of the offer.
     *
     * @param int $id
     * @param array $data
     * @return array
     * @throws ModelNotFoundException
     */
    public function update($id, array $data)
    {
        $offer = Offer::findOrFail($id);
        $offer->update($data);
        return $restaurant;
    }

    /**
     * Delete an offer by its ID.
     *
     * This method deletes an offer and returns its name before deletion. 
     * If the offer doesn't exist, it throws a ModelNotFoundException.
     *
     * @param int $id
     * @return string
     * @throws ModelNotFoundException
     */
    public function destroy($id)
    {
        $offer = Offer::find($id);
        if (!$offer) {
            throw new ModelNotFoundException("Offer with id $id not found.");
        }

        $offername = $offer->name;

        $offer->delete();

        return $offername;
    }
}