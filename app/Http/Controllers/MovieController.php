<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Comments;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function update (Request $request, $movieId) {
        $movie = Movie::where('id', $movieId)->first();
        $movie->name = $request->name;
        $movie->year = $request->year;
        $movie->dir = $request->dir;
        $movie->time = $request->time;
        $movie->img = $request->img;
        $movie->background_img = $request->background_img;
        $movie->video_path = $request->video_path;
        $movie->kinopoisk_id = $request->kinopoisk_id;
        $movie->desk = $request->desk;
        $movie->save();

        $movieInfo = $movie;
        $comments = Comments::where('movie_id', $movieId)->get();
        $isAdmin = 'true';
        $user = Auth::user();
        return view('movie-item',  compact('movieInfo', 'comments', 'isAdmin', 'user'));
    }

    public function add (Request $request) {
        $movie = new Movie;
        $movie->name = $request->name;
        $movie->year = $request->year;
        $movie->dir = $request->dir;
        $movie->time = $request->time;
        $movie->img = $request->img;
        $movie->background_img = $request->background_img;
        $movie->video_path = $request->video_path;
        $movie->kinopoisk_id = $request->kinopoisk_id;
        $movie->desk = $request->desk;
        $movie->save();
        return redirect('/');
    }

    public function delete (Request $request, $id) {
        Movie::where('id', $id)->delete();
        return $request;
    }
}
