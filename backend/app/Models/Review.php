<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'restaurant_id',
        'user_id',
        'comment',
    ];

    /**
     * Get the restaurant that the review belongs to.
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    // Get the user that wrote the review.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
