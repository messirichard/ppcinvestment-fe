<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi
    protected $table = 'transactions';

    // Tentukan kolom yang bisa diisi massal
    protected $fillable = [
        'rcv_address',
        'rcv_amount_token',
        'rcv_currency',
        'rcv_amount_currency',
    ];

    // Tentukan kolom yang harus di-cast menjadi tipe data tertentu
    protected $casts = [
        'rcv_amount_token' => 'decimal:8',
        'rcv_amount_currency' => 'decimal:8',
    ];
}
