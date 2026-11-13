<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Http\Request;

class PesquisaController extends Controller
{
    public function index(Request $r)
    {
        $q = Anuncio::with('user:id,verificado')
            ->where('estado', 'ativo')
            ->where('expira_em', '>', now());

        foreach (['finalidade', 'tipo', 'provincia'] as $c) {
            if ($r->filled($c)) {
                $q->where($c, $r->input($c));
            }
        }

        $moeda = in_array($r->input('moeda'), ['AOA', 'USD'], true) ? $r->input('moeda') : null;
        if ($moeda) {
            $q->where('moeda', $moeda);
        }

        if ($r->filled('q')) {
            $texto = str_replace(['%', '_'], '', trim($r->input('q')));
            $t = '%' . mb_strtolower($texto) . '%';
            $q->where(function ($w) use ($t) {
                $w->whereRaw('LOWER(bairro) LIKE ?', [$t])
                  ->orWhereRaw('LOWER(municipio) LIKE ?', [$t])
                  ->orWhereRaw('LOWER(titulo) LIKE ?', [$t]);
            });
        }

        if ($r->filled('max') && is_numeric($r->input('max'))) {
            $q->where('moeda', $moeda ?? 'AOA')->where('preco', '<=', $r->input('max'));
        }

        match ($r->input('ordem')) {
            'preco_asc' => $q->orderBy('moeda')->orderBy('preco'),
            'preco_desc' => $q->orderBy('moeda')->orderByDesc('preco'),
            default => $q->latest(),
        };

        return view('home', [
            'anuncios' => $q->paginate(10)->withQueryString(),
            'provincias' => Anuncio::distinct()->orderBy('provincia')->pluck('provincia'),
        ]);
    }
}
