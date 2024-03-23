<?php

use App\Http\Controllers\Api\EmotionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\IntensityController;
use App\Http\Controllers\Api\JournalController;
use App\Http\Controllers\Api\UserEmotionController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
->middleware('guest')
->name('login');

Route::post('/register', [RegisteredUserController::class, 'store'])
->middleware('guest')
->name('register');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ->name('logout');
   
Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index');
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});

Route::controller(IntensityController::class)->group(function () {
    Route::get('/intensities', 'index');
    Route::get('/intensities/{id}', [IntensityController::class, 'show']);
    Route::post('/intensities', [IntensityController::class, 'store']);
    Route::put('/intensities/{id}', [IntensityController::class, 'update']);
    Route::delete('/intensities/{id}', [IntensityController::class, 'destroy']);
});

Route::middleware(['auth:sanctum', 'Child'])->group(function () {
    Route::get('/emotions', 'index');
    Route::get('/emotions/{id}', [EmotionController::class, 'show']);
    Route::post('/emotions', [EmotionController::class, 'store']);
    Route::put('/emotions/{id}', [EmotionController::class, 'update']);
    Route::delete('/emotions/{id}', [EmotionController::class, 'destroy']);
});

Route::get('/user-emotions', [UserEmotionController::class, 'index']);
Route::post('/user-emotions', [UserEmotionController::class, 'store']);
Route::put('/user-emotions/{id}', [UserEmotionController::class, 'update']);
Route::delete('/user-emotions/{id}', [UserEmotionController::class, 'destroy']);

Route::middleware(['auth:sanctum', 'Child'])->group(function () {
    Route::get('/journals', 'index');
    Route::get('/journals/{id}', [JournalController::class, 'show']);
    Route::post('/journals', [JournalController::class, 'store']);
    Route::put('/journals/{id}', [JournalController::class, 'update']);
    Route::delete('/journals/{id}', [JournalController::class, 'destroy']);
});