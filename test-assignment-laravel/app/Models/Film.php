<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Genre;

class Film extends Model
{
    public function genres() {
        return $this->belongsToMany(Genre::class, 'films_genres', 'film_id', 'genre_id');
    }
}
