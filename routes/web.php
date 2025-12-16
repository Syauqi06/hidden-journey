<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/jelajah', [PublicController::class, 'explore'])->name('explore');
Route::get('/destinasi/{slug}', [PublicController::class, 'show'])->name('destination.show');   

Route::middleware('auth')->group(function () {
    Route::get('/koleksi-saya', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{id}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminDestinationController::class, 'index'])->name('dashboard');    
    Route::get('/create', [App\Http\Controllers\AdminDestinationController::class, 'create'])->name('create');
    Route::post('/store', [App\Http\Controllers\AdminDestinationController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [App\Http\Controllers\AdminDestinationController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [App\Http\Controllers\AdminDestinationController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [App\Http\Controllers\AdminDestinationController::class, 'destroy'])->name('destroy');
});

require __DIR__.'/auth.php';
