<?php

namespace App\Http\Middleware;

use App\Models\Anuncio;
use App\Support\Contador;
use Closure;
use Illuminate\Http\Request;

class ContarVisita
{
    public function handle(Request $request, Closure $next)
    {
        $resposta = $next($request);

        $a = $request->route('anuncio');
        if (!$a instanceof Anuncio) {
            $a = Anuncio::find($a);
        }

        if ($a && $resposta->getStatusCode() === 200 && Contador::deveContar($request, $a, 'vistos')) {
            Contador::somar($a->id, 'visitas');
        }

        return $resposta;
    }
}
