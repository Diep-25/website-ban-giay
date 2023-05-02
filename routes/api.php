<?php

use App\Http\Controllers\Api\AddressAavailable\AddressAavailableController;
use App\Http\Controllers\Api\Category\CategoriesController;
use App\Http\Controllers\Api\Districts\DistrictsController;
use App\Http\Controllers\Api\Oder\OderController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\Provinces\ProvincesController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\Wards\WardsController;
use App\Http\Middleware\TokenAuthenticaton;
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
    Route::post('register', [UserController::class, 'store']);
    Route::post('login', [UserController::class, 'login']);
});
Route::prefix('users')->group(function () {
});
// Route::middleware(TokenAuthenticaton::class)->group( function () {
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('fillter', [ProductController::class, 'fillter']);
    Route::get('get-by-id', [ProductController::class, 'show']);
    Route::post('create', [ProductController::class, 'store']);
    Route::put('update', [ProductController::class, 'update']);
    Route::delete('delete', [ProductController::class, 'destroy']);
});
// });
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoriesController::class, 'index']);
    Route::get('get-by-id', [CategoriesController::class, 'show']);
    Route::post('create', [CategoriesController::class, 'store']);
    Route::put('update', [CategoriesController::class, 'update']);
    Route::delete('delete', [CategoriesController::class, 'destroy']);
});

Route::prefix('oders')->group(function () {
    Route::post('oder-product', [OderController::class, 'store']);
    Route::put('oder-approves', [OderController::class, 'approve']);
});
Route::middleware(TokenAuthenticaton::class)->group(function () {
    Route::prefix('address')->group(function () {
        Route::post('addressAvailable_add', [AddressAavailableController::class, 'create']);
        Route::get('addressAvailable', [AddressAavailableController::class, 'index']);

        Route::post('provinces_add', [ProvincesController::class, 'create']);
        Route::get('provinces', [ProvincesController::class, 'index']);
        //Route::put('oder-approves', [OderController::class , 'approve']);

        Route::post('districts_add', [DistrictsController::class, 'create']);
        Route::get('districts', [DistrictsController::class, 'getByProvinces']);

        Route::post('wards_add', [WardsController::class, 'create']);
        Route::get('wards', [WardsController::class, 'getByDistrict']);
    });
    Route::prefix('products-admin')->group(function () {
        Route::post('create', [ProductController::class, 'store']);
        Route::put('update', [ProductController::class, 'update']);
        Route::delete('delete', [ProductController::class, 'destroy']);
    });
});
