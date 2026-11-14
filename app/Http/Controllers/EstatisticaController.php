<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Support\Facades\DB;

class EstatisticaController extends Controller
{
    public function __invoke(Anuncio $anuncio)
    {
        abort_unless($anuncio->user_id === auth()->id(), 403);

        $dias = [];
        for ($i = 13; $i >= 0; $i--) {
            $d = now('Africa/Luanda')->subDays($i)->toDateString();
            $dias[$d] = ['visitas' => 0, 'contactos' => 0];
        }

        $linhas = DB::table('anuncio_estatisticas')
            ->where('anuncio_id', $anuncio->id)
            ->whereBetween('data', [array_key_first($dias), array_key_last($dias)])
            ->get();

        foreach ($linhas as $l) {
            $k = substr((string) $l->data, 0, 10);
            if (isset($dias[$k])) {
                $dias[$k] = ['visitas' => (int) $l->visitas, 'contactos' => (int) $l->contactos];
            }
        }

        $total = DB::table('anuncio_estatisticas')
            ->where('anuncio_id', $anuncio->id)
            ->selectRaw('coalesce(sum(visitas),0) as v, coalesce(sum(contactos),0) as c')
            ->first();

        return view('estatisticas', [
            'anuncio' => $anuncio,
            'dias' => $dias,
            'maximo' => max(1, (int) collect($dias)->max('visitas')),
            'totalVisitas' => (int) $total->v,
            'totalContactos' => (int) $total->c,
        ]);
    }
}
