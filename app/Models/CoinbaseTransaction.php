<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoinbaseTransaction extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari default
    protected $table = 'coinbase_transactions';

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'name',
        'description',
        'amount',
        'currency',
        'status',
        'coinbase_charge_id',
        'wallet_address',
    ];

    // Jika menggunakan timestamps, Anda bisa menghapus metode ini jika tidak diperlukan
    public $timestamps = true;

}
