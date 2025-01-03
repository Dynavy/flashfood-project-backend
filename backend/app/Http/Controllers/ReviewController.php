<?php

namespace App\Http\Controllers;

use App\Services\ReviewService;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{
    // Inject ReviewService into the controller.
    public function __construct(private ReviewService $reviewService) {}

    // Retrieve and return a paginated list of all reviews.
    public function index()
    {
        // Pagination in case the reviews list is large.
        $reviews = $this->reviewService->index()->paginate(50);
        return response()->json([
            'message' => 'Review retrieved successfully!',
            'status' => 'success',
            'data' => $reviews
        ], 200);
    }

    // Retrieve and return a specific review by its ID.
    public function show($id)
    {
        $review = $this->reviewService->showByID($id);
        return response()->json([
            'message' => 'Review retrieved successfully!',
            'status' => 'success',
            'data' => $review
        ], 200);
    }

    // Create and store a new review.
    public function store(ReviewRequest $request)
    {
        // Delegate the creation logic to the service layer.
        $review = $this->reviewService->store($request->validated());
        return response()->json([
            'message' => 'Review created successfully!',
            'review' => $review,
        ], status: 201);
    }

    // Update a specific review by its ID.
    public function update(ReviewRequest $request, $id)
    {
        $review = $this->reviewService->update($id, $request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Review updated successfully!',
            'data' => $review,
        ], status: 200);
    }

    // Delete a specific review by its ID.
    public function destroy($id)
    {
        // Delegate the deletion logic to the service layer.
        $reviewName = $this->reviewService->destroy($id);

        return response()->json([
            'message' => "Review $reviewName with id $id deleted successfully."
        ], 200);
    }
}
