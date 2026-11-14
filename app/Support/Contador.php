<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Contador
{
    public static function somar(int $anuncioId, string $coluna): void
    {
        if (!in_array($coluna, ['visitas', 'contactos'], true)) {
            return;
        }

        $hoje = now('Africa/Luanda')->toDateString();
        $q = DB::table('anuncio_estatisticas')->where('anuncio_id', $anuncioId)->where('data', $hoje);

        if ($q->exists()) {
            $q->increment($coluna);
            return;
        }

        try {
            DB::table('anuncio_estatisticas')->insert([
                'anuncio_id' => $anuncioId,
                'data' => $hoje,
                'visitas' => $coluna === 'visitas' ? 1 : 0,
                'contactos' => $coluna === 'contactos' ? 1 : 0,
            ]);
        } catch (\Throwable $e) {
            $q->increment($coluna);
        }
    }

    public static function deveContar(Request $r, $anuncio, string $chaveSessao): bool
    {
        $ua = strtolower((string) $r->userAgent());
        if ($ua === '' || preg_match('/bot|crawl|spider|slurp|facebookexternalhit|whatsapp|preview|go-http-client|uptimerobot|curl|wget|python|monitor|headless/', $ua)) {
            return false;
        }

        $u = $r->user();
        if ($u && ((int) $u->id === (int) $anuncio->user_id || $u->admin)) {
            return false;
        }

        if ($anuncio->estado !== 'ativo' || $anuncio->expirado) {
            return false;
        }

        $feitos = (array) $r->session()->get($chaveSessao, []);
        if (in_array($anuncio->id, $feitos, true)) {
            return false;
        }
        $feitos[] = $anuncio->id;
        $r->session()->put($chaveSessao, $feitos);

        return true;
    }
}
