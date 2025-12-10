<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GoApiController;

// Public endpoint untuk mendapatkan token (Client Credentials Grant)
Route::post('/oauth/token', function () {
    // Handled by Passport - route ini dihandle oleh package Passport
})->middleware('throttle:60,1');

// API Routes yang dilindungi dengan Passport Authentication
Route::middleware('auth:api')->group(function () {
    // Endpoint 1: Get Weather
    Route::get('/weather', [GoApiController::class, 'getWeather']);
    
    // Endpoint 2: Get Currency
    Route::get('/currency', [GoApiController::class, 'getCurrency']);
    
    // Endpoint 3: Get News
    Route::get('/news', [GoApiController::class, 'getNews']);
    
    // Endpoint 4: Post Data
    Route::post('/data', [GoApiController::class, 'postData']);
});
