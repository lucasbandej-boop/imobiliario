@extends('layout')
@section('titulo', 'Entrar')
@section('conteudo')
<h2>Entrar</h2>
<form method="POST" action="/entrar">
  @csrf
  <input name="email" type="email" placeholder="Email" value="{{ old('email') }}">
  <input name="password" type="password" placeholder="Palavra-passe">
  @foreach($errors->all() as $e)<p class="erro">{{ $e }}</p>@endforeach
  <button class="btn">Entrar</button>
</form>
<p class="sm" style="text-align:center;margin-top:12px">Ainda não tem conta? <a href="/registo">Criar conta</a></p>
<p class="sm" style="text-align:center"><a href="/esqueci">Esqueci a palavra-passe</a></p>
@endsection
