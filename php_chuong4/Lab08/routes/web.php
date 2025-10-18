<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products/expensive', [ProductController::class, 'expensiveProducts'])->name('products.expensive');


Route::resource('products', ProductController::class);
Route::get('/students', [StudentController::class, 'index']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);

Route::get('/users/{user}/profile/edit', [UserController::class, 'editProfile']);
Route::post('/users/{user}/profile', [UserController::class, 'storeProfile']);
Route::put('/users/{user}/profile', [UserController::class, 'updateProfile']);

