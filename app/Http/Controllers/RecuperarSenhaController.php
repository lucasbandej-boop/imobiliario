<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class RecuperarSenhaController extends Controller
{
    public function form(string $token, Request $r)
    {
        return view('nova-senha', ['token' => $token, 'email' => $r->query('email')]);
    }

    public function guardar(Request $r)
    {
        $r->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $estado = Password::reset(
            $r->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $senha) use ($r) {
                $user->forceFill([
                    'password' => Hash::make($senha),
                    'remember_token' => Str::random(60),
                ])->save();
                Auth::login($user);
                $r->session()->regenerate();
            }
        );

        if ($estado === Password::PASSWORD_RESET) {
            return redirect('/painel');
        }

        return back()
            ->withInput($r->only('email'))
            ->withErrors(['email' => 'Link inválido ou expirado. Peça um novo link.']);
    }
}
