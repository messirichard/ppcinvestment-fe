<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [TransactionController::class, 'showTotalLeftToken'])->name('transactions.buy');
Route::get('/tx', [TransactionController::class, 'index'])->name('transactions.index');

Route::get('/checkout', [StripeController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [StripeController::class, 'handleCheckout'])->name('checkout.post');

Route::get('/checkout/success', [StripeController::class, 'checkoutSuccess'])->name('checkout.success');
Route::get('/checkout/cancel', [StripeController::class, 'checkoutCancel'])->name('checkout.cancel');

