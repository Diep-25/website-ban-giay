<?php

use App\Http\Controllers\Api\Category\CategoriesController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\User\UserController;
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

Route::prefix('home')->group(function () {
    Route::post('register', [UserController::class,'store']);
});
Route::prefix('users')->group(function () {

});
Route::prefix('categories')->group(function () {
    Route::get('/',[CategoriesController::class, 'index']);
    Route::get('get-by-id',[CategoriesController::class, 'show']);
    Route::post('create',[CategoriesController::class, 'store']);
    Route::put('update',[CategoriesController::class, 'update']);
    Route::delete('delete',[CategoriesController::class, 'destroy']);
});
Route::prefix('products')->group(function () {
    Route::get('/',[ProductController::class, 'index']);
    Route::get('get-by-id',[ProductController::class, 'show']);
    Route::post('create',[ProductController::class, 'store']);
    Route::put('update',[ProductController::class, 'update']);
    Route::delete('delete',[ProductController::class, 'destroy']);
});
