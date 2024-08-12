<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeftToken extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi
    protected $table = 'left_tokens';

    // Tentukan kolom yang bisa diisi massal
    protected $fillable = [
        'left_token_amount',
    ];

    // Tentukan kolom yang harus di-cast menjadi tipe data tertentu
    protected $casts = [
        'left_token_amount' => 'decimal:8',
    ];
}
