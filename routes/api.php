<?php

use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\DeveloperController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rotta API
Route::get('developers', [DeveloperController::class, 'index']);
Route::get('/developers/{slug}', [DeveloperController::class, 'show']);


Route::resource('reviews', ReviewController::class);
    
// Ratings
Route::resource('ratings', RatingController::class);