<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EmpleadoAuth {
    public function handle(Request $request, Closure $next) {
        if(auth()->check() && auth()->user()->role == 'empleado') {
            return $next($request);
        }
        return redirect()->to('/');
    }
}

