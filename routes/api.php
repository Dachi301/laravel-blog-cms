<?php

use App\Http\Controllers\SubCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('categories', CategoryController::class)->parameters([
        'categories' => 'category:slug',
    ]);

    Route::get('categories/{category:slug}/sub-categories', [SubCategoryController::class, 'index']);
    Route::post('categories/{category:slug}/sub-categories', [SubCategoryController::class, 'store']);
    Route::get('categories/{category:slug}/sub-categories/{id}', [SubCategoryController::class, 'show']);
    Route::put('categories/{category:slug}/sub-categories/{id}', [SubCategoryController::class, 'update']);
    Route::delete('categories/{category:slug}/sub-categories/{id}', [SubCategoryController::class, 'destroy']);
});
