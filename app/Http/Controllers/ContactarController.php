<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use App\Support\Contador;
use Illuminate\Http\Request;

class ContactarController extends Controller
{
    public function __invoke(Request $r, Anuncio $anuncio)
    {
        $disponivel = $anuncio->estado === 'ativo' && !$anuncio->expirado;
        if (!$disponivel) {
            return redirect('/anuncio/' . $anuncio->id);
        }

        if (Contador::deveContar($r, $anuncio, 'contactados')) {
            Contador::somar($anuncio->id, 'contactos');
        }

        $texto = 'Olá, vi o anúncio "' . $anuncio->titulo . '" no CasaAngola e tenho interesse.';
        return redirect()->away('https://wa.me/' . $anuncio->whatsapp . '?text=' . urlencode($texto));
    }
}
