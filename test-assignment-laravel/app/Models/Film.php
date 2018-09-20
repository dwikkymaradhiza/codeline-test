<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Genre;
use App\Models\Comment;

class Film extends Model
{
    public function genres() {
        return $this->belongsToMany(Genre::class, 'films_genres', 'film_id', 'genre_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'film_id')->orderBy('created_at', 'desc');
    }
 }
