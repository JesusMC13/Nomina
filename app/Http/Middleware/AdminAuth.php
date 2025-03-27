<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // Este middleware se asegura de que solo los administradores puedan acceder a ciertas rutas.
public function handle(Request $request, Closure $next)
{
    if (auth()->check()) {
        if (auth()->user()->role == 'admin') {
            return $next($request);
        }
    }

    // Si el usuario no es administrador, se redirige al dashboard del empleado.
    return redirect()->route('empleado.dashboard');
}

    
}
