<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
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

// show all listings route
Route::get('/', [ListingController::class, 'index']);

// show create listing form route
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

//  create listing form route
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// edit listing form route
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

Route::get('/listings/manage', [ListingController::class, 'manage']);

// update listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// delete listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// show single listings route
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// show register
Route::get('/register', [UserController::class, 'create'])->middleware('guest');
Route::post('/users', [UserController::class, 'store']);

// logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

Route::post('/users/authenticate', [UserController::class, 'authenticate']);
