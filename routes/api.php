<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\AuthController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/entries', [EntryController::class, 'index']);
    Route::post('/entries', [EntryController::class, 'store']);
    Route::put('/entries/{id}/status', [EntryController::class, 'updateStatus']);
    Route::get('/entries/statistics', [EntryController::class, 'statistics']);
    Route::delete('/entries/{id}', [EntryController::class, 'destroy']);
});
Route::get('/entries/categories', [EntryController::class, 'categories']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
