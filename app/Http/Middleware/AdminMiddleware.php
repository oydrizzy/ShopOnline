<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('usuario') || session('usuario.rol') !== 'admin') {
            return redirect('/')->with('error', 'Acceso denegado.');
        }
        return $next($request);
    }
}
