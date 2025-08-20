<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
Route::post('/users/create', [UserController::class, 'store'])->name("user.store");
Route::get('/users/show/{id}', [UserController::class, 'show'])->name('user.show');
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/users/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/users/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
require __DIR__ . '/auth.php';
