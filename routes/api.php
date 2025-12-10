<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GoApiController;
use Laravel\Passport\Http\Middleware\CheckClientCredentials;

// Protected routes dengan Client Credentials (M2M/H2H)
Route::middleware(CheckClientCredentials::class)->group(function () {
    Route::get('/weather', [GoApiController::class, 'getWeather']);
    Route::get('/currency', [GoApiController::class, 'getCurrency']);
    Route::get('/news', [GoApiController::class, 'getNews']);
    Route::post('/data', [GoApiController::class, 'postData']);
});
