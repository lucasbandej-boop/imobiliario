<?php

namespace App\Console\Commands;

use App\Models\Anuncio;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Password;

class SenhaLink extends Command
{
    protected $signature = 'senha:link {email}';
    protected $description = 'Gera um link de nova palavra-passe (valido 60 minutos)';

    public function handle(): int
    {
        $user = User::where('email', $this->argument('email'))->first();
        if (!$user) {
            $this->error('Conta nao encontrada.');
            return self::FAILURE;
        }

        $numeros = Anuncio::where('user_id', $user->id)->pluck('whatsapp')->unique()->implode(', ');
        $this->line('Nome: ' . $user->name);
        $this->line('WhatsApp nos anuncios: ' . ($numeros ?: '(sem anuncios)'));

        $token = Password::createToken($user);
        $base = config('site.url', 'https://imobiliario-4zrp.onrender.com');

        $this->newLine();
        $this->info('Envie este link (valido 60 minutos, uso unico):');
        $this->line($base . '/nova-senha/' . $token . '?email=' . urlencode($user->email));

        return self::SUCCESS;
    }
}
