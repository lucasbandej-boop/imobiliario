<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    protected $guarded = [];

    protected $casts = [
        'fotos' => 'array',
        'expira_em' => 'datetime',
    ];

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
}
