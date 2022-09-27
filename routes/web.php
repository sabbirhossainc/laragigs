<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing  

// Link the storage

Route::get('/link', function(){
    Artisan::call('storage:link');
});

// All listing
Route::get('/', [ListingController::class, 'index']);

// Show Create From
Route::get('/listings/create', [ListingController::class, 'create'])
    ->middleware('auth');

// Srote listing data
Route::post('/listings', [ListingController::class, 'store'])
    ->middleware('auth');

// Show edit from
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])
    ->middleware('auth');

// Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])
    ->middleware('auth');

// Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])
    ->middleware('auth');

// Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])  // method App\Http\Controllers\UserController::manage does not exist. (BadMethodCallException) 
    ->middleware('auth');

// ---Single listing---
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Show register
Route::get('/register', [UserController::class, 'create'])
    ->middleware('guest');

// Create new user
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])
    ->middleware('auth');

// Show Login form
Route::get('/login', [UserController::class, 'login'])
    ->name('login')
    ->middleware('guest');

// Log in User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);




// db connection check
Route::get('/dbconn', function () {
    return view('dbconn');
});
