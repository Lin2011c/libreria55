<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Iluminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //validar si el usuario tiene sesion activa
        if(!Auth::check()){
            return redirect()->route('registro')
            ->with('error','se debe registrar e iniciar sesion');

            //validar si el usuario actual es admin
            if(Auth::user()->is_admin){
                return redirect()->route('libro.index')
                ->with('error','no cuentas con permisos de admin');
            }
        }
        return $next($request);
    }
}
