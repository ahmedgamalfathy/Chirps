<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::middleware('auth:sanctum')->post('/logout',[AuthController::class,'logout']);
Route::Post('login',[AuthController::class,'login']);
Route::Post('register',[AuthController::class,'register']);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
