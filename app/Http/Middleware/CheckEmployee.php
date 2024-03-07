<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckEmployee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Verificar si el usuario autenticado es un empleado
            if (Auth::user()->role_id == 2) { // Cambia is_employee por el nombre real del campo que indica si es empleado
                return $next($request);
            }
        }

        // Si el usuario no es un empleado, redirigirlo a otra ubicación
        return redirect('/'); // Puedes cambiar '/' por la ruta a la que quieres redirigir
    }
}
