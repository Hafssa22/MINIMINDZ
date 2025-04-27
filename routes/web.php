<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\KidsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/kids', function () {
    return view('kids.index');
});

Route::prefix('kids')->group(function () {
    Route::get('/', [KidsController::class, 'index'])->name('kids.home');
    Route::get('/{category}', [KidsController::class, 'showCategory'])->name('kids.category');
}); 



Route::middleware(['auth'])->prefix('tutor')->group(function () {
    Route::get('/dashboard', function () {
        return view('tutor.dashboard');
    })->name('tutor.dashboard');

    Route::resource('contents', ContentController::class);
});
Route::get('/tutor', function () {
    return redirect('/tutor/dashboard');
});
