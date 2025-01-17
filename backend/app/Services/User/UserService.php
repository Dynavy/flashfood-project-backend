<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService
{
    /**
     * Retrieve all users.
     *
     * This method retrieves all the users from the database and returns the query builder for further customization if needed.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function index()
    {
        return User::query();
    }

    /**
     * Retrieve a specific user by its ID.
     *
     * This method fetches a user by its ID from the database. 
     * If the user doesn't exist, it throws a ModelNotFoundException.
     *
     * @param int $id
     * @return User
     * @throws ModelNotFoundException
     */
    public function showByID($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    /**
     * Find a user by its name.
     *
     * This method searches for a user using the 'name' attribute. 
     * If no user is found, it throws a ModelNotFoundException.
     *
     * @param string $name
     * @return User
     * @throws ModelNotFoundException
     */
    public function findByName($name)
    {
        return User::where('name', $name)->firstOrFail();
    }

    /**
     * Store a new user in the database.
     *
     * This method creates and stores a new user using the provided data.
     *
     * @param array $data
     * @return User
     */
    public function store(array $data): User
    {
        return User::create($data);
    }

    /**
     * Update an existing user by its ID.
     *
     * This method finds a user by its ID and updates it with the provided data.
     *
     * @param int $id
     * @param array $data
     * @return User
     * @throws ModelNotFoundException
     */
    public function update(int $id, array $data): User
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    /**
     * Delete a user by its ID.
     *
     * This method deletes a user and returns its name before deletion. 
     * It uses database transactions to ensure the operation is atomic.
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
            $user = User::findOrFail($id);
            $userName = $user->name;
            $user->delete();

            DB::commit();
            return $userName;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
