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

Route::prefix('staff')->group(function () {
    Route::apiResource('staff', \App\Http\Controllers\StaffController::class);
    Route::get('{staff}/gym', [\App\Http\Controllers\StaffController::class, 'gym'])->name('staff.gym');
});

Route::prefix('membership')->group(function () {
    Route::apiResource('membership', \App\Http\Controllers\MembershipController::class);
    Route::get('{membership}/gym', [\App\Http\Controllers\MembershipController::class, 'gym'])->name('membership.gym');
});

Route::prefix('member')->group(function () {
    Route::apiResource('member', \App\Http\Controllers\MemberController::class);
    Route::get('{member}/gym', [\App\Http\Controllers\MemberController::class, 'gym'])->name('member.gym');
});