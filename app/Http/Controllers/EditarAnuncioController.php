<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use App\Support\Fotos;
use Illuminate\Http\Request;

class EditarAnuncioController extends Controller
{
    public function form(Anuncio $anuncio)
    {
        abort_unless($anuncio->user_id === auth()->id(), 403);
        return view('editar', compact('anuncio'));
    }

    public function guardar(Request $r, Anuncio $anuncio)
    {
        abort_unless($anuncio->user_id === auth()->id(), 403);

        $d = $r->validate([
            'titulo' => 'required|max:120',
            'tipo' => 'required|in:casa,apartamento,terreno',
            'finalidade' => 'required|in:arrendar,vender',
            'preco' => 'required|numeric|min:0',
            'provincia' => 'required|max:60',
            'municipio' => 'nullable|max:60',
            'bairro' => 'nullable|max:60',
            'quartos' => 'nullable|integer|min:0|max:50',
            'casas_banho' => 'nullable|integer|min:0|max:50',
            'descricao' => 'nullable|max:2000',
            'whatsapp' => 'required|regex:/^[0-9+ ]{9,15}$/',
            'novas' => 'nullable|array|max:5',
            'novas.*' => 'image|max:2048',
            'remover' => 'nullable|array',
        ]);

        $fotos = $anuncio->fotos ?? [];
        $remover = $r->input('remover', []);
        $fotos = array_values(array_filter($fotos, fn ($f) => !in_array($f, $remover, true)));

        foreach ($r->file('novas', []) as $f) {
            if (count($fotos) >= 5) break;
            $fotos[] = Fotos::guardar($f);
        }

        $w = preg_replace('/\D/', '', $d['whatsapp']);
        $d['whatsapp'] = strlen($w) === 9 ? '244' . $w : $w;
        $d['fotos'] = $fotos;
        unset($d['novas'], $d['remover']);

        $anuncio->update($d);
        return redirect('/painel');
    }
}
