<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\LeftToken;


use App\Models\TokenPrice;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Models\CoinbaseTransaction;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

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
                'currency' => 'required|string|in:usd,eur,crypto',
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
            } elseif ($currency === 'crypto') {

                // URL API Coinbase Commerce
                $url = 'https://api.commerce.coinbase.com/charges/';

                // Data yang akan dikirim (dalam bentuk array)
                $data = [
                    "name" => "RoyalCoins Purchase",
                    "description" => "Purchase of RoyalCoins",
                    "pricing_type" => "fixed_price",
                    "local_price" => [
                        "amount" => $usdAmount.'.00', // Jumlah dalam USD
                        "currency" => 'USD'
                    ],
                    "metadata" => [
                        "wallet_address" => $request->wallet, // Menyimpan alamat wallet dalam metadata
                        "token_amount" => $request->royalCoinAmount
                    ],
                    "redirect_url" => route('checkout.success') . '?session_id=coinbase',
                    "cancel_url" => route('checkout.cancel'),
                ];

                // Encode data ke JSON
                $jsonData = json_encode($data);

                // API Key Coinbase Commerce Anda
                $apiKey = env('COINBASE_API_KEY');

                // Kirim permintaan POST ke Coinbase Commerce
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'X-CC-Api-Key' => $apiKey
                ])->post($url, $data);

                // Cek jika ada error
                if ($response->failed()) {
                    return response()->json(['error' => 'Failed to create charge'], 500);
                }

                // Ambil data dari respons
                $responseData = $response->json();
                $chargeId = $responseData['data']['id'];
                $checkoutUrl = $responseData['data']['hosted_url'];

                // Simpan data transaksi ke database
                CoinbaseTransaction::create([
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'amount' => $usdAmount,
                    'currency' => $currency,
                    'coinbase_charge_id' => $chargeId,
                    'wallet_address' => $request->wallet,
                ]);

                // Redirect ke URL checkout Coinbase Commerce
                return redirect($checkoutUrl);
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

        if($sessionId === 'coinbase') {
            return view('checkout.success');
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Ambil informasi sesi dari Stripe
        $session = \Stripe\Checkout\Session::retrieve($sessionId);

        // Convert amount from cents to dollars or euros
        $amountTotal = $session->amount_total / 100;

        // Cek mata uang yang digunakan (USD atau EUR)
        $currency = strtoupper($session->currency);
        $royalCoinAmount = 0;

        if ($currency === 'USD') {
            // Jika mata uang adalah USD, langsung hitung RoyalCoins
            $royalCoinAmount = $this->calculateRoyalCoinAmount($amountTotal);
        } elseif ($currency === 'EUR') {
            // Jika mata uang adalah EUR, konversi ke USD terlebih dahulu
            $eurToUsdRate = $this->getEurToUsdRate();
            $amountInUsd = $amountTotal * $eurToUsdRate;
            $royalCoinAmount = $this->calculateRoyalCoinAmount($amountInUsd);
        }

        // Ambil alamat wallet dari metadata
        $walletAddress = $session->metadata->wallet_address;

        // Simpan transaksi ke database
        Transaction::create([
            'rcv_address' => $walletAddress,
            'rcv_amount_token' => $royalCoinAmount,
            'rcv_currency' => $currency,
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

    private function calculateRoyalCoinAmount($usdAmount)
    {
        // Dapatkan harga token dari tabel TokenPrice
        $price = TokenPrice::sum('price'); // Harga RoyalCoin dalam USD
        return $usdAmount / $price;
    }

    private function getEurToUsdRate()
    {
        // Mengambil kurs EUR ke USD dari ExchangeRate-API
        $response = Http::get('https://api.exchangerate-api.com/v4/latest/USD');
        $rates = $response->json()['rates'];

        return $rates['EUR']; // Mengembalikan kurs EUR ke USD
    }

    public function checkoutCancel()
    {
        return view('checkout.cancel');
    }
}
