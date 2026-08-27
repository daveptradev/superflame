<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // BELUM LOGIN
        if (!Auth::check()) {
            return redirect('/');
        }

        // BUKAN ADMIN
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        return $next($request);
    }
}