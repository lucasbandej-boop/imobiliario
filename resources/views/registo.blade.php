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
  @foreach($errors->all() as $e)<p class="erro">{{ $e }}</p>@endforeach
  <button class="btn">Criar conta</button>
</form>
@endsection
