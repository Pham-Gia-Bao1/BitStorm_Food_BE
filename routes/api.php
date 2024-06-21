<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;

Route::get('/foods', [FoodController::class, 'index']);
Route::get('/foods/filter/{type}', [FoodController::class, 'filter']);
Route::get('/foods/sort/{type}', [FoodController::class, 'sortByPrice']);
Route::get('/admin/foods', [FoodController::class, 'adminIndex']);
Route::get('/foods/{id}', [FoodController::class, 'show']);
Route::get('/foods/{id}/edit', [FoodController::class, 'getForUpdate']);
Route::delete('/foods/{id}', [FoodController::class, 'destroy']);
Route::post('/foods', [FoodController::class, 'create']);
Route::put('/foods/{id}', [FoodController::class, 'update']);
