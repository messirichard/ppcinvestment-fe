<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'api/*', // Mengecualikan semua rute yang dimulai dengan 'api/'
        'webhook/*', // Mengecualikan semua rute yang digunakan untuk menerima webhook
    ];

}
