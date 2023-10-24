<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckFormMateriaUnicaCompletion
{
    
    public function handle(Request $request, Closure $next): Response
    {
        if (session('formularioMU_completado')) {
            return $next($request); // Permite la solicitud
        }

        return redirect()->route('login.show', ['userType' => 'ALUMNOS']);
    }
}
