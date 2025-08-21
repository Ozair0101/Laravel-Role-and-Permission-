<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
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
// auth()->user()->can(role.view)
Route::get('/users', [UserController::class, 'index'])->name('user.index')->middleware('permission:role.view|role.create|role.edit|role.delete');
Route::get('/users/create', [UserController::class, 'create'])->name('user.create')->middleware('permission:role.create');
Route::post('/users/create', [UserController::class, 'store'])->name("user.store");
Route::get('/users/show/{id}', [UserController::class, 'show'])->name('user.show')->middleware('permission:role.view');
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('user.edit')->middleware('permission:role.edit');
Route::put('/users/update/{id}', [UserController::class, 'update'])->name('user.update')->middleware('permission:role.edit');
Route::delete('/users/delete/{id}', [UserController::class, 'delete'])->name('user.delete')->middleware('permission:role.delete');

Route::get('/roles', [RoleController::class, 'index'])->name('role.index')->middleware('permission:role.view|role.create|role.edit|role.delete');
Route::get('/roles/create', [RoleController::class, 'create'])->name('role.create')->middleware('permission:role.create');
Route::post('/roles/create', [RoleController::class, 'store'])->name('role.store')->middleware('permission:role.create');
Route::get('/roles/show/{id}', [RoleController::class, 'show'])->name('role.show')->middleware('permission:role.view');
Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('role.edit')->middleware('permission:role.edit');
Route::put('/roles/update/{id}', [RoleController::class, 'update'])->name('role.update')->middleware('permission:role.edit');
Route::delete('/roles/delete/{id}', [RoleController::class, 'destroy'])->name('role.delete')->middleware('permission:role.delete');
require __DIR__ . '/auth.php';
