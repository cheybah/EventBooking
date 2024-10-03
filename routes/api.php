<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ClientAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['auth:sanctum', 'role:ADMIN'])->group(function () {
    Route::delete('/event/{id}', [EventController::class, 'destroy']);
});


// Event routes
Route::get('events', [EventController::class, 'index']);
Route::post('events', [EventController::class, 'store']);
Route::get('events/{id}', [EventController::class, 'show']);
Route::put('events/{id}', [EventController::class, 'update']);
Route::delete('events/{id}', [EventController::class, 'destroy']);

// Booking routes
Route::get('events/{eventId}/bookings', [BookingController::class, 'index']);
Route::post('bookings', [BookingController::class, 'store']);
Route::delete('bookings/{id}', [BookingController::class, 'destroy']);

// Auth routes (I used Laravel Sanctum)
Route::post('client/register', [ClientAuthController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
