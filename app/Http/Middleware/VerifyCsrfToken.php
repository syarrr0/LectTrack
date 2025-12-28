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
        // TAMBAH ROUTE CHATBOT ANDA DI SINI
        'api/chat',
        
        // Anda boleh tambah route API lain di sini jika perlu dikecualikan
        // cth: 'api/*', 
    ];
}