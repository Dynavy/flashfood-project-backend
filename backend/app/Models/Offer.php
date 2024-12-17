<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offers';

    protected $fillable = [
        'restaurant_id',
        //'user_id',
        'name',
        'description',
        'popularity',
        'status',
        'valid_from',
        'valid_until',
    ];

    protected $dates = [
        'valid_from',
        'valid_until',
        'created_at',
        'updated_at',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    //public function user()
    //{
    //    return $this->belongsTo(User::class);
    //}
}
