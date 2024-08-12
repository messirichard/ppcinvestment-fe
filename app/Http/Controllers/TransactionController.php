<?php

namespace App\Http\Controllers;

use App\Models\LeftToken;
use App\Models\TokenPrice;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all(); // Atau gunakan query sesuai kebutuhan
        return view('transak', compact('transactions'));
    }

    public function showTotalLeftToken()
    {
        // Mengambil total left_token_amount
        $totalLeftToken = LeftToken::sum('left_token_amount');
        $price = TokenPrice::sum('price');


        // Mengirim data ke view
        return view('landing2', compact('totalLeftToken', 'price'));
    }
}
