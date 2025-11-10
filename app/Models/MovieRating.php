<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class MovieRating extends Model
{
    protected $fillable = [
        'title',
        'year',
        'poster',
        'rating',
        'user_id',
    ];

    /**
     * Get the user's first name.
     */
    protected function imdbID(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['imdb_id'],
        );
    }
}
