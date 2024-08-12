<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Illuminate\Http\Request;


use Stripe\Checkout\Session;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class StripeController extends Controller
{
    public function checkout()
    {
        return view('checkout');
    }

    public function handleCheckout(Request $request)
    {
        // Validasi input
        $request->validate([
            'wallet' => 'required|string',
            'usdAmount' => 'required|string',
            'royalCoinAmount' => 'required|numeric|min:1',
        ]);

        // Membersihkan input dari karakter koma
        $usdAmount = str_replace(',', '', $request->usdAmount);

        // Konversi ke float untuk memastikan jumlah dalam format angka
        $usdAmount = (float)$usdAmount;

        // Konversi ke cents (Stripe bekerja dengan cents)
        $usdAmountInCents = $usdAmount * 100;

        // Set Stripe API Key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Buat session Stripe untuk pembayaran
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'RoyalCoins',
                    ],
                    'unit_amount' => $usdAmountInCents, // Harga dalam cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
        ]);

        // Redirect ke halaman Stripe checkout
        return redirect($session->url);
    }
}
