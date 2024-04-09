<?php

use App\Http\Controllers\ArtistsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SongsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/////artistRoutes//////////////////////////////
Route::controller(ArtistsController::class)->group(function () {

Route::get('artists','index');
Route::post('store_artist','store');
Route::get('show_artist/{artist}','show');
Route::post('update_artist/{artist}');
Route::delete('delete_artist/{artist}');
});


///////songRoutes////////////////////////////////
Route::controller(SongsController::class)->group(function () {
Route::post('store_songs','store');
Route::get('show_songs/{songs}','show');
Route::get('songs','index');

});



/////////auth Router///////////////////////////////////////////
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout')->middleware('auth:api');
    Route::post('refresh', 'refresh')->middleware('auth:api');
});


////////////profileControoler Routes///
Route::controller(ProfileController::class)->group(function () {
    Route::get('profiles','index');
    Route::post('store_Profile/{song_id}','store');
    Route::get('show_Profile/{profile}','show');
});
