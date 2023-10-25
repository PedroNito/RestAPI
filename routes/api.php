<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/games/search', 'GameController@search')->name('games.search');
Route::apiResource('games','GameController');

Route::get('/genres/search', 'GenreController@search')->name('genres.search');
Route::apiResource('genres','GenreController');

Route::get('/platforms/search', 'PlatformController@search')->name('platforms.search');
Route::apiResource('platforms','PlatformController');
