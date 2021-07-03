<?php

use App\Http\Controllers\Api\Auth\TokenAuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::middleware('auth:sanctum')->name('api.cart.')->prefix('cart')->group(function () {

    Route::post('summary', [CartController::class, 'apiGetSummary'])->name('summary');

    Route::post('update', [CartController::class, 'apiUpdateCart'])->name('update');

    Route::post('product/add/barcode', [CartController::class, 'apiAddProductToCartWithBarcode'])->name('add');

    Route::post('product/remove/barcode', [CartController::class, 'apiRemoveProductFromCartWithBarcode'])->name('remove');

});


Route::post('categories/all', [CategoryController::class, 'all'])->name('category.all');

Route::post('category/products', [CategoryController::class, 'categoryProducts'])->name('category.products');

Route::post('product/barcode', [ProductController::class, 'productFromBarcode'])->name('product.barcode');


Route::prefix('auth')->group(function () {

    Route::post('/register', [TokenAuthController::class, 'register']);

    Route::post('/login', [TokenAuthController::class, 'login']);

});

Route::post('payment/success', [PaymentController::class, 'stripeCallback']);

Route::middleware('auth:sanctum')->post('/user', function (Request $request) {
    return $request->user()->toJson();
});
