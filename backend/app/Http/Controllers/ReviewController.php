<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Display a listing of the reviews.
    public function index()
    {
        $reviews = Review::all();
        return response()->json($reviews);
    }

    // Store a newly created review in storage.
    public function store(Request $request)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'user_id' => 'required|exists:users,id',
            'comment' => 'required|string',
        ]);

        $review = Review::create($request->all());
        return response()->json($review, 201);
    }

    // Display the specified review.
    public function show(Review $review)
    {
        return response()->json($review);
    }

    //Update the specified review in storage.
    public function update(Request $request, Review $review)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $review->update($request->all());
        return response()->json($review);
    }

    // Remove the specified review from storage.
    public function destroy(Review $review)
    {
        $review->delete();
        return response()->json(null, 204);
    }
}
