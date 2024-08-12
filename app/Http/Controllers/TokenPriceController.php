<?php

namespace App\Http\Controllers;

use App\Models\LeftToken;
use App\Models\TokenPrice;
use Illuminate\Http\Request;

class TokenPriceController extends Controller
{
    public function index()

    {
        $totalLeftToken = LeftToken::sum('left_token_amount');
        $tokenPrice = TokenPrice::sum('price');
        return view('landing2',[
            'totalLeftToken' => $totalLeftToken,
            'price' => $tokenPrice
        ]);
    }
}
