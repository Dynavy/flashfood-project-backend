<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // This trait allows the model to use Laravel factories for creating new instances.
    // Factories help create realistic sample data for development, testing, and seeding purposes.
    use HasFactory;

    // Allows to mass assign data to the name attribute when creating or updating records.
    protected $fillable = ['name'];

    /**
     * Define the N:M relationship between Category and Restaurant.
     * 
     * This method establishes that a category can be associated with multiple
     * restaurants through the table 'restaurant_categories'. It allows 
     * us to retrieve the restaurants related to a specific category using 
     * Eloquent's relationship features.
     */
    public function restaurants()
    {
        return $this->belongsToMany(Category::class, 'restaurant_categories', 'restaurant_id', 'category_id');
    }
}
