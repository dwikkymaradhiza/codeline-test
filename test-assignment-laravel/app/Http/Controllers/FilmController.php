<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Comment;

class FilmController extends Controller
{
    /**
     * Show the film lists.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filmObj = new Film;
        $films = $filmObj->simplePaginate(1);
        return view('frontend.film.index', compact('films'));
    }

    /**
     * Show the film detail.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $film = Film::where('slug', $slug)->firstOrFail();
        return view('frontend.film.detail', compact('film'));
    }
}
