<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MessageController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AdController::class, 'index'])->name('home');
Route::resource('ads', AdController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('ads/{ad}/favorite', [FavoriteController::class, 'toggle'])->name('ads.toggleFavorite');
    Route::resource('messages', MessageController::class)->only(['index','create','store','show']);

});

require __DIR__.'/auth.php';
