<?php

use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('landing');
});

Route::get('/checkout', [StripeController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [StripeController::class, 'handleCheckout'])->name('checkout.post');

Route::get('/checkout-success', function () {
    return 'Payment successful! You will receive your RoyalCoins shortly.';
})->name('checkout.success');

Route::get('/checkout-cancel', function () {
    return 'Payment was cancelled.';
})->name('checkout.cancel');
