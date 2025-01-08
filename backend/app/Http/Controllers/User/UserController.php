<?php

namespace App\Http\Controllers;

use App\Services\User\UserService;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    // Inject UserService into the controller.
    public function __construct(private UserService $userService) {}

    // Retrieve and return a paginated list of all users.
    public function index()
    {
        $users = $this->userService->index()->paginate(50);
        return response()->json([
            'message' => 'Users retrieved successfully!',
            'status' => 'success',
            'data' => $users,
        ], 200);
    }

    // Retrieve and return a user by its ID.
    public function show($id)
    {
        $user = $this->userService->showByID($id);
        return response()->json([
            'message' => 'User retrieved successfully!',
            'status' => 'success',
            'data' => $user,
        ], 200);
    }

    // Search and return a user by their name.
    public function findByName($name)
    {
        $userName = $this->userService->findByName($name);
        return response()->json([
            'message' => 'User retrieved successfully!',
            'status' => 'success',
            'data' => $userName,
        ], 200);
    }

    // Create and store a new user.
    public function store(UserRequest $request)
    {
        // Delegate creation logic to the service layer.
        $user = $this->userService->store($request->validated());
        return response()->json([
            'message' => 'User created successfully!',
            'status' => 'success',
            'data' => $user,
        ], 201);
    }

    // Update a specific user by its ID.
    public function update(UserRequest $request, $id)
    {
        $user = $this->userService->update($id, $request->validated());
        return response()->json([
            'message' => 'User updated successfully!',
            'status' => 'success',
            'data' => $user,
        ], 200);
    }

    // Delete a specific user by its ID.
    public function destroy($id)
    {
        // Delegate deletion logic to the service layer.
        $userName = $this->userService->destroy($id);

        return response()->json([
            'message' => "User $userName with id $id deleted successfully.",
            'status' => 'success',
        ], 200);
    }
}
