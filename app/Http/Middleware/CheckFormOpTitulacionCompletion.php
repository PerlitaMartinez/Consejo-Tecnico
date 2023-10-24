<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckFormOpTitulacionCompletion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('formularioOT_completado')) {
            return $next($request); // Permite la solicitud
        }

        return redirect()->route('login.show', ['userType' => 'ALUMNOS']);
    }
}
