<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'restaurant_id',
        'user_id',
        'comment',
        'likes'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get the restaurant that the review belongs to.
     *
     * This method defines the relationship between a review and a restaurant.
     * It indicates that each review belongs to a single restaurant.
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    /**
     * Get the user that wrote the review.
     *
     * This method defines the relationship between a review and a user.
     * It indicates that each review is written by a single user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}