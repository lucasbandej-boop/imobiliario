@extends('layout')
@section('titulo', 'Nova palavra-passe')
@section('conteudo')
<h2>Nova palavra-passe</h2>
<form method="POST" action="/nova-senha">
  @csrf
  <input type="hidden" name="token" value="{{ $token }}">
  <input name="email" type="email" placeholder="Email" value="{{ old('email', $email) }}">
  <input name="password" type="password" placeholder="Nova palavra-passe (mínimo 6)">
  <input name="password_confirmation" type="password" placeholder="Repetir palavra-passe">
  @foreach($errors->all() as $e)<p class="erro">{{ $e }}</p>@endforeach
  <button class="btn">Guardar nova palavra-passe</button>
</form>
@endsection
