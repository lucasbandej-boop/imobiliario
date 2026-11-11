<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

class Fotos
{
    public static function guardar(UploadedFile $f): string
    {
        $base = env('SUPABASE_URL');
        $key = env('SUPABASE_KEY');

        if (!$base || !$key) {
            return $f->store('anuncios', 'public');
        }

        $nome = uniqid('f_') . '.jpg';
        $tipo = $f->getMimeType() ?: 'image/jpeg';
        $h = ['apikey' => $key];
        if (!str_starts_with($key, 'sb_')) {
            $h['Authorization'] = 'Bearer ' . $key;
        }

        Http::withHeaders($h)
            ->withBody(file_get_contents($f->getRealPath()), $tipo)
            ->post($base . '/storage/v1/object/fotos/' . $nome)
            ->throw();

        return $base . '/storage/v1/object/public/fotos/' . $nome;
    }

    public static function url(string $p): string
    {
        return str_starts_with($p, 'http') ? $p : asset('storage/' . $p);
    }
}
