<?php

namespace App\Services;

use App\Models\Review;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
    public function store(array $data): Review
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
    public function updateReview(int $id, array $data): Review
    {
        $review = Review::findOrFail($id);
        $review->update($data);
        return $review;
    }

    // Delete a review.
    public function deleteReview(int $id): string
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
