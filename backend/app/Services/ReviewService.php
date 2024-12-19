<?php

namespace App\Services;

use App\Models\Review;
use App\Models\Restaurant;
use App\Models\User;

class ReviewService
{
    // Index method on ReviewController.
    public function index()
    {
        return Review::query();
    }

    // Show method on ReviewController.
    public function showByID($id)
    {
        // throw new ModelNotFoundException("test");
        $review = Review::findOrFail($id);
        return $review;
    }

    // Create a new review.
    public function createReview(array $data): Review
    {
        $restaurant = Restaurant::findOrFail($data['restaurant_id']);
        $user = User::findOrFail($data['user_id']);

        $review = new Review([
            'restaurant_id' => $restaurant->id,
            'user_id' => $user->id,
            'comment' => $data['comment'],
        ]);

        $review->save();

        return $review;
    }

    // Update an existing review.
    public function updateReview(Review $review, array $data): Review
    {
        $review->update($data);

        return $review;
    }

    // Delete a review.
    public function deleteReview(Review $review): void
    {
        $review->delete();
    }
}
