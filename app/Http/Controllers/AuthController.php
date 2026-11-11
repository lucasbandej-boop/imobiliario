<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registo(Request $r)
    {
        $d = $r->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
        Auth::login(User::create($d));
        return redirect('/painel');
    }

    public function entrar(Request $r)
    {
        $c = $r->validate(['email' => 'required|email', 'password' => 'required']);
        if (Auth::attempt($c)) {
            $r->session()->regenerate();
            return redirect('/painel');
        }
        return back()->withErrors(['email' => 'Email ou palavra-passe incorretos.'])->onlyInput('email');
    }

    public function sair(Request $r)
    {
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();
        return redirect('/');
    }
}
