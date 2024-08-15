<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\LeftToken;


use App\Models\TokenPrice;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class StripeController extends Controller
{
    public function handleCheckout(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'wallet' => 'required|string',
                'usdAmount' => 'required|string',
                'royalCoinAmount' => 'required|numeric',
                'currency' => 'required|string|in:usd,eur',
            ]);

            // Membersihkan input dari karakter koma
            $usdAmount = str_replace(',', '', $request->usdAmount);

            // Konversi ke float untuk memastikan jumlah dalam format angka
            $usdAmount = (float)$usdAmount;

            // Konversi ke cents (Stripe bekerja dengan cents)
            $usdAmountInCents = $usdAmount * 100;

            // Set Stripe API Key
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $currency = strtolower($request->currency);
            $paymentMethodTypes = [];

            if ($currency === 'usd') {
                $paymentMethodTypes = [
                    'card',          // Kartu Kredit/Debit
                    'cashapp',       // Cash App
                    'klarna',        // Klarna (Buy Now, Pay Later)
                    'us_bank_account', // US Bank Account
                ];
                if ($usdAmount <= 30000) {
                    $paymentMethodTypes[] = 'affirm'; // Include Affirm only if USD amount is $30,000 or less
                }
            } elseif ($currency === 'eur') {
                $paymentMethodTypes = [
                    'card',        // Kartu Kredit/Debit
                    'ideal',       // iDEAL (Belanda)
                    'bancontact',  // Bancontact (Belgia)
                    'eps',         // EPS (Austria)
                    'p24',         // Przelewy24 (Polandia)
                ];
                if ($usdAmount <= 10000) {
                    $paymentMethodTypes[] = 'sepa_debit';
                }
            }

            // Memeriksa apakah wallet address adalah '0x000F'
            if ($request->wallet === '0x000F') {
                // Jika benar, set harga menjadi $1 (100 cents)
                $usdAmountInCents = 100; // $1 dalam cents
            }

            // Memeriksa apakah wallet address adalah '0x000F'
            if ($request->wallet === '0x000F') {
                // Jika benar, set harga menjadi $1 (100 cents)
                $usdAmountInCents = 100; // $1 dalam cents
            }

            $session = Session::create([
                'payment_method_types' => $paymentMethodTypes,
                'line_items' => [[
                    'price_data' => [
                        'currency' => $currency,
                        'product_data' => [
                            'name' => 'RoyalCoins',
                        ],
                        'unit_amount' => $usdAmountInCents, // Harga dalam cents
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout.cancel'),
                'metadata' => [
                    'wallet_address' => $request->wallet, // Menyimpan alamat wallet dalam metadata
                ],
            ]);


            // Redirect ke halaman Stripe checkout
            return redirect($session->url);
        } catch (\Exception $e) {
            // Catch any exceptions and return back with error message
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function checkoutSuccess(Request $request)
    {
        $sessionId = $request->query('session_id'); // Ambil session_id dari URL

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = \Stripe\Checkout\Session::retrieve($sessionId);


        $amountTotal = $session->amount_total / 100; // Convert from cents to dollars
        $royalCoinAmount = $this->calculateRoyalCoinAmount($amountTotal); // Implement this method

        // Ambil alamat wallet dari metadata
        $walletAddress = $session->metadata->wallet_address;

        // Simpan transaksi ke database
        Transaction::create([
            'rcv_address' => $walletAddress,
            'rcv_amount_token' => $royalCoinAmount,
            'rcv_currency' => $session->currency,
            'rcv_amount_currency' => $amountTotal,
        ]);

        // Update tabel left_tokens

        // Memeriksa apakah wallet address adalah '0x000F'
        if ($walletAddress !== '0x000F') {
            // Jika wallet address bukan '0x000F', maka kurangi left_token_amount
            LeftToken::query()->decrement('left_token_amount', $royalCoinAmount);
        }


        return view('checkout.success'); // Tampilkan halaman sukses
    }

    public function checkoutCancel()
    {
        return view('checkout.cancel');
    }

    private function calculateRoyalCoinAmount($usdAmount)
    {
        // Misalkan 1 RoyalCoin = $5000
        $price = TokenPrice::sum('price');
        return $usdAmount / $price;
    }
}
