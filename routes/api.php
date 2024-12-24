<?php

use App\Http\Controllers\PlanController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::apiResource('trip',TripController::class);
Route::apiResource('review',ReviewController::class);
Route::apiResource('plan',PlanController::class);
Route::post('contact', ContactController::class);