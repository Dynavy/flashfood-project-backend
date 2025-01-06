<?php

namespace App\Services\Review;

use App\Models\Review;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReviewService
{
    /**
     * Retrieve all reviews.
     *
     * This method retrieves all the reviews from the database and returns the query builder for further customization if needed.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function index()
    {
        return Review::query();
    }

    /**
     * Retrieve a specific review by its ID.
     *
     * This method fetches a review by its ID from the database. 
     * If the review doesn't exist, it throws a ModelNotFoundException.
     *
     * @param int $id
     * @return Review
     */
    public function showByID($id)
    {
        $review = Review::findOrFail($id);
        return $review;
    }

    /**
     * Store a new review in the database.
     *
     * This method creates and stores a new review using the provided data. 
     * It checks if the related restaurant and user exist before creating the review.
     *
     * @param array $data
     * @return Review
     */
    public function store(array $data): Review
    {
        $restaurant = Restaurant::findOrFail($data['restaurant_id']);
        $user = User::findOrFail($data['user_id']);

        $review = new Review([
            'restaurant_id' => $restaurant->id,
            'user_id' => $user->id,
            'comment' => $data['comment'],
            'likes' => isset($data['likes']) ? $data['likes'] : 0,
        ]);

        $review->save();

        return $review;
    }

    /**
     * Increment the 'likes' for a review.
     *
     * This method increments the 'likes' attribute of a review by 1.
     *
     * @param int $id
     * @return Review
     */
    public function incrementLikes(int $id): Review
    {
        $review = Review::findOrFail($id);
        $review->increment('likes');
        return $review;
    }

    /**
     * Update an existing review.
     *
     * This method finds an existing review by its ID and updates it with the provided data.
     *
     * @param int $id
     * @param array $data
     * @return Review
     */
    public function update(int $id, array $data): Review
    {
        $review = Review::findOrFail($id);
        $review->update($data);
        return $review;
    }

    /**
     * Delete a review from the database.
     *
     * This method deletes a review and uses database transactions to ensure the operation is atomic.
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

            $review = Review::findOrFail($id);
            $restaurantName = $review->restaurant->name;
            $review->delete();

            DB::commit();

            return $restaurantName;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
