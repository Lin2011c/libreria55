<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        // Verificación de inicio de sesión
        if (!Auth::check()) {
            return redirect()->route('registro')
                ->with('error', 'Se debe iniciar sesión');
        }

        // Verificación de administrador
        if (!Auth::user()->is_admin) {
            return redirect()->route('libros.index')
                ->with('error', 'No cuentas con permisos de administraor');
        }

        return $next($request);
    }
}
