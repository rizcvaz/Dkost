<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        'midtrans/callback',  // URL callback midtrans yang mau dikecualikan dari CSRF
    ];
}
