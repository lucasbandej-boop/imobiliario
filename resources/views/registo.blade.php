@extends('layout')
@section('titulo', 'Criar conta')
@section('conteudo')
<h2>Criar conta</h2>
<form method="POST" action="/registo">
  @csrf
  <input name="name" placeholder="Nome" value="{{ old('name') }}">
  <input name="email" type="email" placeholder="Email" value="{{ old('email') }}">
  <input name="password" type="password" placeholder="Palavra-passe">
  <input name="password_confirmation" type="password" placeholder="Repetir palavra-passe">
  <label class="sm" style="display:flex;gap:8px;align-items:flex-start"><input type="checkbox" name="aceito" value="1" style="width:auto;margin-top:3px"> <span>Li e aceito os <a href="/termos" target="_blank">Termos de Uso</a> e a <a href="/privacidade" target="_blank">Política de Privacidade</a>.</span></label>
  @foreach($errors->all() as $e)<p class="erro">{{ $e }}</p>@endforeach
  <button class="btn">Criar conta</button>
</form>
<p class="sm" style="text-align:center;margin-top:12px">Já tem conta? <a href="/entrar">Entrar</a></p>
@endsection
