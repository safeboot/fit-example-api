<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(\App\Http\Middleware\ForceJsonResponse::class)->group(function () {

    Route::get('/cars', [\App\Http\Controllers\CarController::class, 'index']);
    Route::post('/cars', [\App\Http\Controllers\CarController::class, 'store']);

    Route::get('/brands', [\App\Http\Controllers\BrandController::class, 'index']);
    Route::post('/brands', [\App\Http\Controllers\BrandController::class, 'store']);


});
