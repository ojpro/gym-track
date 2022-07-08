<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('owner')->group(function () {
    Route::apiResource('owner', \App\Http\Controllers\OwnerController::class);
    Route::get('{owner}/gyms', [\App\Http\Controllers\OwnerController::class, 'gyms'])->name('owner.gyms');
});

Route::prefix('gym')->group(function () {
    Route::apiResource('gym', \App\Http\Controllers\GymController::class);
    Route::get('{gym}/owner', [\App\Http\Controllers\GymController::class, 'owner'])->name('gym.owner');
});