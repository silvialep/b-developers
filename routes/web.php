<?php

use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DeveloperController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('/developer/{developer}', [HomepageController::class, 'show'])->name('developer.show');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/errors', function () {
    return view('errors.notfound');
})->name('error');

Route::get('error', [DeveloperController::class, 'error'])->name('error');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function() {

    Route::resource('profile', DeveloperController::class);
    Route::get('/', [DashboardController::class, 'home'])->name('dashboard.home');

    Route::resource('messages', MessageController::class);
    Route::resource('reviews', ReviewController::class);

    // Advertisements
    Route::resource('advertisements', AdvertisementController::class);
});

require __DIR__.'/auth.php';
