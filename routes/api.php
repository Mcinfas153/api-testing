<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('product', [ProductController::class, 'store'])->name('product.store');
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('product/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::put('product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('product/{id}', [ProductController::class, 'delete'])->name('product.delete');
    Route::get('logout', [UserController::class, 'logout']);
});

Route::post('register', [UserController::class, 'register'])->name('user.create');
Route::post('login', [UserController::class, 'login'])->name('user.login');
