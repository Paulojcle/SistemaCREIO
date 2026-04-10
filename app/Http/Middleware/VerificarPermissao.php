<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarPermissao
{
    public function handle(Request $request, Closure $next, string ...$permissoes): Response
    {
        $usuario = $request->user();

        $temAlguma = collect($permissoes)->some(fn($p) => $usuario?->temPermissao($p));

        if (!$temAlguma) {
            return redirect()->route('index')->with('error', 'Você não tem permissão para acessar esta página.');
        }

        return $next($request);
    }
}
