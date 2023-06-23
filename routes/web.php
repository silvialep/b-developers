<?php

use App\Http\Controllers\Admin\Adv_DevController;
use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DeveloperController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\RatingController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\ChartJSController;
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

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function() {

    Route::resource('profile', DeveloperController::class);
    Route::get('/', [DashboardController::class, 'home'])->name('dashboard.home');

    Route::resource('messages', MessageController::class);
    

    // Advertisements
    Route::resource('advertisements', AdvertisementController::class);

    // Reviews
    Route::resource('reviews', ReviewController::class);
    
    // Ratings
    Route::resource('ratings', RatingController::class);

    // Statistics
    Route::get('chart', [ChartJSController::class, 'index'])->name('statistics');

});

Route::post('/adv_dev', [Adv_DevController::class, 'saveAdv'])
->middleware('auth')
->name('adv_dev');


require __DIR__.'/auth.php';
