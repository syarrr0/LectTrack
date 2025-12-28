<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLecturerLogin
{
    public function handle(Request $request, Closure $next)
    {
        // Semak jika lecturer belum login
        if (!session()->has('lecturer_id')) {
            return redirect()->route('lecturer.login')->with('login_error', 'Sila log masuk dahulu.');
        }

        return $next($request);
    }
}
