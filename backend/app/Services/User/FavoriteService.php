<?php

namespace App\Services\User;

use App\Models\Favorite;

class FavoriteService
{
  /**
   * Retrieve all favorites from the database.
   *
   * @return \Illuminate\Database\Eloquent\Collection
   */
  public function index(): \Illuminate\Database\Eloquent\Collection
  {
    return Favorite::with(['user', 'restaurant'])->get();
  }

  /**
   * Retrieve a specific favorite by its ID.
   *
   * @param int $id
   * @return Favorite
   */
  public function showByID(int $id): Favorite
  {
    return Favorite::with(['user', 'restaurant'])->findOrFail($id);
  }

  /**
   * Store a new favorite in the database.
   *
   * @param array $data
   * @return Favorite
   */
  public function store(array $data): Favorite
  {
    return Favorite::create($data);
  }

  /**
   * Update an existing favorite by its ID.
   *
   * @param int $id
   * @param array $data
   * @return Favorite
   */
  public function update(int $id, array $data): Favorite
  {
    $favorite = Favorite::findOrFail($id);
    $favorite->update($data);

    return $favorite;
  }

  /**
   * Delete a favorite by its ID.
   *
   * @param int $id
   * @return Favorite
   */
  public function destroy(int $id): Favorite
  {
    $favorite = Favorite::findOrFail($id);
    $favorite->delete();

    return $favorite;
  }
}
