<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::get('/', function () {
    $isAdmin = 'false';
    $user = Auth::user();
    $data = \App\Movie::all();
    if (Auth::user() && Auth::user()->email === 'yurikwbc@gmail.com') {
        $isAdmin = 'true';
    }
    return view('home', compact('data', 'user', 'isAdmin'));
});

Route::post('/comment', function (Request $request) {
    $comments = new \App\Comments;
    $comments->username=$request->get('username');
    $comments->movie_id=$request->get('movie_id');
    $comments->comment=$request->get('comment');
    $comments->save();

    $newComment = $comments::where('comment', $request->get('comment'))->get();
    return $newComment;

});


Route::put('/cart/{movieId}', 'MovieController@update');

Route::post('/cart', 'MovieController@add');

Route::delete('/cart/{id}', 'MovieController@delete');

Route::get('/cart/{movieId}', function ($movieId) {
   $isAdmin = 'false';
   $comments = \App\Comments::where('movie_id', $movieId)->get();
   $movieInfo = \App\Movie::where('id', $movieId)->first();
   if (Auth::user() && Auth::user()->email = 'yurikwbc@gmail.com') {
        $isAdmin = 'true';
    }
    $user = Auth::user();
   return view('movie-item', compact('movieInfo', 'comments', 'isAdmin', 'user'));

});

Auth::routes();

Route::get('/home', function () {
    return redirect('/');
});

Route::get('/faggot-test', 'FaggotController@get');
