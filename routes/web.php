<?php

use App\Http\Controllers\Api\ApiTokensController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Models\Cart;
use App\Models\Category;
use App\Models\PaymentIntent;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('landing');

Route::get('test', function () {
    $category = Category::all()->random();
    dd($category, $category->products);
});

Route::get('products', [ProductController::class, 'showAllProducts'])->name('products.all');

Route::middleware(['auth:sanctum'])->group(function () {


    Route::get('user/cart', [CartController::class, 'show'])->name('user.cart');

    Route::get('user/cart/checkout', [PaymentController::class, 'issuePaymentEvent'])->name('user.cart.checkout');

    Route::get('/dashboard', [DashboardController::class, 'show'])->middleware(['verified'])->name('dashboard');

    Route::get('payment/success', [PaymentController::class, 'showCallbackPage'])->name('payment.success');

    Route::delete('all-api-tokens', [ApiTokensController::class, 'destroy'])->name('all-api-tokens.destroy');

    Route::delete('api-token', [ApiTokensController::class, 'deleteApiToken'])->name('api-token.deleteApiToken');

    //Merchant routes
    Route::prefix('merchant')->name('merchant.')->middleware(['merchant'])->group(function () {

        Route::get('product/new', [ProductController::class, 'showCreate'])->name('product.new');

        Route::put('product/new', [ProductController::class, 'create'])->name('product.add');

        Route::get('product/update/{id}', [ProductController::class, 'showUpdate'])->name('product.view');

        Route::put('product/update', [ProductController::class, 'update'])->name('product.update');

        Route::delete('product/delete', [ProductController::class, 'destroy'])->name('product.destroy');

    });

    //Cart action routes
    Route::middleware('auth:sanctum')->name('cart.')->prefix('cart')->group(function () {

        Route::post('add-product', [CartController::class, 'addProductToCart'])->name('add');

        Route::post('remove-product', [CartController::class, 'removeProductFromCart'])->name('remove');

    });
});
