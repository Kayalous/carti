<?php

use App\Http\Controllers\Api\ApiTokensController;
use App\Models\Cart;
use Illuminate\Foundation\Application;
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

Route::get('/test', function () {
    return Inertia::render('Welcome');
})->middleware('merchant');

Route::delete('all-api-tokens', [ApiTokensController::class, 'destroy'])->name('all-api-tokens.destroy');
Route::delete('api-token', [ApiTokensController::class, 'deleteApiToken'])->name('api-token.deleteApiToken');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    if (Auth::user()->can('administrate'))
        return Inertia::location('/admin');
    else
        return Inertia::location('/user/profile');
})->name('dashboard');


