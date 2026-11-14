<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Anuncio extends Model
{
    protected $guarded = [];

    protected $casts = [
        'fotos' => 'array',
        'expira_em' => 'datetime',
    ];

    protected ?array $statsCache = null;

    protected static function booted(): void
    {
        static::creating(function ($a) {
            if (!$a->expira_em) {
                $a->expira_em = now()->addDays(30);
            }
        });

        static::updating(function ($a) {
            if ($a->getOriginal('estado') === 'suspenso' && $a->estado !== 'suspenso') {
                return false;
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getExpiradoAttribute(): bool
    {
        return $this->expira_em !== null && $this->expira_em->isPast();
    }

    public function publicadoTexto(): string
    {
        $d = $this->created_at->copy()->setTimezone('Africa/Luanda');
        return $d->format('d/m/Y') . ' às ' . $d->format('H:i');
    }

    public function validoAteTexto(): string
    {
        $d = ($this->expira_em ?? $this->created_at->copy()->addDays(30))->copy()->setTimezone('Africa/Luanda');
        return $d->format('d/m/Y');
    }

    public function precoTexto(): string
    {
        $n = number_format((float) $this->preco, 0, ',', '.');
        return $n . ' ' . ($this->moeda === 'USD' ? 'USD' : 'Kz');
    }

    public function resumoStats(): array
    {
        if ($this->statsCache === null) {
            $t = DB::table('anuncio_estatisticas')
                ->where('anuncio_id', $this->id)
                ->selectRaw('coalesce(sum(visitas),0) as v, coalesce(sum(contactos),0) as c')
                ->first();
            $this->statsCache = ['visitas' => (int) $t->v, 'contactos' => (int) $t->c];
        }
        return $this->statsCache;
    }
}
