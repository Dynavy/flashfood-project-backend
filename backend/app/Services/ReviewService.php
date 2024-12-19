<?php

namespace App\Services;

use App\Models\Review;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReviewService
{
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
