<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductsController::class, 'list'])->name('shop');
Route::get('/product:{id}', [ProductsController::class, 'details'])->name('details')->whereNumber('id');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');

    Route::get('/orders', [OrderController::class, 'viewUserAll'])->name('orders');

    Route::get('/order:{id}', [OrderController::class, 'view'])->name('order.view')->whereUuid('id');
    Route::patch('/order:{id}', [OrderController::class, 'update'])->name('order.update')->whereUuid('id');
});
Route::get('/cart', [CartController::class, 'view'])->name('cart');
Route::patch('/cart', [CartController::class, 'add'])->name('cart.add');

Route::get('/external:{id}', [OrderController::class, 'external'])->name('external')->whereUuid('id');
Route::post('/paid:{id}', [OrderController::class, 'paid'])->name('order.dummy.paid')->whereUuid('id');

require __DIR__.'/auth.php';
