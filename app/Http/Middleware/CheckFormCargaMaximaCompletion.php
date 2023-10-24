<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckFormCargaMaximaCompletion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('formularioCM_completado')) {
            return $next($request); // Permite la solicitud
        }

        return redirect()->route('login.show', ['userType' => 'ALUMNOS']);
    }

    public function opcionTitulacionStore(Request $request){

    }
}
