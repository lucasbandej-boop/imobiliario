<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnuncioController extends Controller
{
    public function index(Request $r)
    {
        $q = Anuncio::where('estado', 'ativo')->latest();
        foreach (['finalidade', 'tipo', 'provincia'] as $c) {
            if ($r->filled($c)) $q->where($c, $r->input($c));
        }
        return view('home', [
            'anuncios' => $q->paginate(10)->withQueryString(),
            'provincias' => Anuncio::distinct()->orderBy('provincia')->pluck('provincia'),
        ]);
    }

    public function show(Anuncio $anuncio)
    {
        return view('anuncio', compact('anuncio'));
    }

    public function painel()
    {
        return view('painel', [
            'anuncios' => Anuncio::where('user_id', auth()->id())->latest()->get(),
        ]);
    }

    public function store(Request $r)
    {
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
            'fotos' => 'nullable|array|max:5',
            'fotos.*' => 'image|max:2048',
        ]);

        $fotos = [];
        foreach ($r->file('fotos', []) as $f) {
            $fotos[] = $f->store('anuncios', 'public');
        }
        $d['fotos'] = $fotos;

        $w = preg_replace('/\D/', '', $d['whatsapp']);
        $d['whatsapp'] = strlen($w) === 9 ? '244' . $w : $w;
        $d['user_id'] = auth()->id();

        Anuncio::create($d);
        return redirect('/painel');
    }

    public function estado(Request $r, Anuncio $anuncio)
    {
        abort_unless($anuncio->user_id === auth()->id(), 403);
        $e = $r->validate(['estado' => 'required|in:ativo,arrendado,vendido'])['estado'];
        $anuncio->update(['estado' => $e]);
        return back();
    }

    public function destroy(Anuncio $anuncio)
    {
        abort_unless($anuncio->user_id === auth()->id(), 403);
        foreach ($anuncio->fotos ?? [] as $f) {
            Storage::disk('public')->delete($f);
        }
        $anuncio->delete();
        return back();
    }
}
