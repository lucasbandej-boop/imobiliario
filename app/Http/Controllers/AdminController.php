<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

class AdminController extends Controller
{
    public function inicio()
    {
        return view('admin.inicio', [
            'utilizadores' => User::count(),
            'verificados' => User::where('verificado', true)->count(),
            'ativos' => Anuncio::where('estado', 'ativo')->where('expira_em', '>', now())->count(),
            'expirados' => Anuncio::where('estado', 'ativo')->where('expira_em', '<=', now())->count(),
            'suspensos' => Anuncio::where('estado', 'suspenso')->count(),
            'fechados' => Anuncio::whereIn('estado', ['arrendado', 'vendido'])->count(),
            'ultimos' => Anuncio::latest()->take(5)->get(),
            'novos' => User::latest()->take(5)->get(),
        ]);
    }

    public function anuncios(Request $r)
    {
        $q = Anuncio::with('user:id,name,email,verificado')->latest();

        if ($r->filled('estado')) {
            $q->where('estado', $r->input('estado'));
        }

        if ($r->filled('q')) {
            $texto = trim($r->input('q'));
            $t = '%' . mb_strtolower(str_replace(['%', '_'], '', $texto)) . '%';
            $q->where(function ($w) use ($t, $texto) {
                $w->whereRaw('LOWER(titulo) LIKE ?', [$t])
                  ->orWhereRaw('LOWER(bairro) LIKE ?', [$t])
                  ->orWhereIn('user_id', User::whereRaw('LOWER(email) LIKE ?', [$t])->select('id'));
                if (ctype_digit($texto)) {
                    $w->orWhere('id', (int) $texto);
                }
            });
        }

        return view('admin.anuncios', [
            'anuncios' => $q->paginate(15)->withQueryString(),
        ]);
    }

    public function anuncioEstado(Request $r, $id)
    {
        $e = $r->validate(['estado' => 'required|in:ativo,suspenso,arrendado,vendido'])['estado'];
        Anuncio::where('id', $id)->update(['estado' => $e]);
        return back();
    }

    public function anuncioApagar($id)
    {
        Anuncio::where('id', $id)->delete();
        return back();
    }

    public function utilizadores(Request $r)
    {
        $q = User::query()
            ->addSelect(['anuncios_total' => Anuncio::selectRaw('count(*)')->whereColumn('anuncios.user_id', 'users.id')])
            ->latest();

        if ($r->filled('q')) {
            $t = '%' . mb_strtolower(str_replace(['%', '_'], '', trim($r->input('q')))) . '%';
            $q->where(function ($w) use ($t) {
                $w->whereRaw('LOWER(name) LIKE ?', [$t])->orWhereRaw('LOWER(email) LIKE ?', [$t]);
            });
        }

        return view('admin.utilizadores', [
            'utilizadores' => $q->paginate(15)->withQueryString(),
        ]);
    }

    public function selo($id)
    {
        $u = User::findOrFail($id);
        $u->verificado = !$u->verificado;
        $u->save();
        return back();
    }

    public function bloquear($id)
    {
        $u = User::findOrFail($id);
        abort_if($u->admin, 403);

        $u->bloqueado = !$u->bloqueado;
        $u->save();

        if ($u->bloqueado) {
            Anuncio::where('user_id', $u->id)->where('estado', 'ativo')->update(['estado' => 'suspenso']);
            DB::table('sessions')->where('user_id', $u->id)->delete();
        }

        return back();
    }

    public function linkSenha($id)
    {
        $u = User::findOrFail($id);
        if ($u->bloqueado) {
            return back()->withErrors(['conta' => 'Esta conta está bloqueada. Desbloqueie-a primeiro.']);
        }

        $token = Password::createToken($u);
        $base = config('site.url', 'https://imobiliario-4zrp.onrender.com');
        $link = $base . '/nova-senha/' . $token . '?email=' . urlencode($u->email);
        $numeros = Anuncio::where('user_id', $u->id)->pluck('whatsapp')->unique()->values()->all();

        return view('admin.link', compact('u', 'link', 'numeros'));
    }
}
