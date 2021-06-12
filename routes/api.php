<?php

use App\Http\Controllers\Api\Auth\TokenAuthController;
use App\Http\Controllers\CartController;
use App\Models\Cart;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::middleware('auth:sanctum')->prefix('cart')->group(function () {

    Route::post('summary', [CartController::class, 'getSummary']);

    Route::post('update', [CartController::class, 'updateCart']);

    Route::post('add-product', [CartController::class, 'addProductToCart']);

    Route::post('remove-product', [CartController::class, 'removeProductFromCart']);

});


Route::prefix('auth')->group(function () {

    Route::post('/register', [TokenAuthController::class, 'register']);

    Route::post('/login', [TokenAuthController::class, 'login']);

});

Route::middleware('auth:sanctum')->post('/user', function (Request $request) {
    return $request->user()->toJson();
});
