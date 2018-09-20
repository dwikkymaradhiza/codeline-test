<?php

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

Route::get('/', function () {
    return redirect()->route('films');
});

Route::get('/films', ['as' => 'films', 'uses' => 'FilmController@index']);
Route::get('/films/{slug}', ['as' => 'films.detail', 'uses' => 'FilmController@show']);

Route::prefix('admin')->namespace('Admin')->group(function () {
  // LOGIN
  Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm' ]);
  Route::post('login', [   'as' => '', 'uses' => 'Auth\LoginController@login']);

  // REGISTRATION
  Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
  Route::post('register', 'Auth\RegisterController@register');

  // PASSWORD RESET
  Route::post('password/email', [ 'as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
  Route::get('password/reset', ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
  Route::post('password/reset', ['as' => '', 'uses' => 'Auth\ResetPasswordController@reset']);
  Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);

  Route::middleware(['auth'])->group(function () {
    Route::post('logout', [ 'as' => 'logout', 'uses' => 'Auth\LoginController@logout' ]);
    Route::get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@index' ]);

    // PROFILE
    Route::get('/profile/edit', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit' ]);
    Route::put('/profile/edit', ['as' => 'profile.update', 'uses' => 'ProfileController@update' ]);

    // FILM
    Route::get('film/data', [ 'as' => 'film.data', 'uses' => 'FilmController@data']);
    Route::resource('film', 'FilmController');
  });
});
