<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'latitude',
        'longitude',
        'google_place_id',
        'phone',
        'website',
        'rating',
    ];

    /**
     * Get the categories associated with the restaurant.
     *
     * This method establishes the many-to-many relationship between
     * the Restaurant and Category models. A restaurant can belong
     * to many categories through the 'restaurant_categories' pivot table.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'restaurant_categories', 'restaurant_id', 'category_id');
    }
}