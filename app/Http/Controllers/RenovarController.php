<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;

class RenovarController extends Controller
{
    public function __invoke(Anuncio $anuncio)
    {
        abort_unless($anuncio->user_id === auth()->id(), 403);
        $anuncio->update(['expira_em' => now()->addDays(30)]);
        return back();
    }
}
