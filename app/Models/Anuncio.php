<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    protected $guarded = [];

    protected $casts = ['fotos' => 'array'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
