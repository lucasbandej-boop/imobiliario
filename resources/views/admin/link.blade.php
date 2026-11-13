@extends('layout')
@section('titulo', 'Administração - Link de nova palavra-passe')
@section('conteudo')
@include('admin._menu')
<h2>Link de nova palavra-passe</h2>
<div class="card">
  <b>{{ $u->name }}</b>
  <div class="sm">{{ $u->email }}</div>
  <div class="sm">WhatsApp usados nos anúncios: {{ count($numeros) ? implode(', ', $numeros) : '(sem anúncios)' }}</div>
</div>
<p class="sm">Só envie o link se o pedido veio de um número que bate com os do dono. O link vale 60 minutos e só pode ser usado uma vez.</p>
<form onsubmit="return false"><input readonly value="{{ $link }}" onclick="this.select()"></form>
@foreach($numeros as $n)
  <p><a class="btn" style="display:block;text-align:center;text-decoration:none" href="https://wa.me/{{ $n }}?text={{ urlencode('Olá! Aqui está o link para criar uma nova palavra-passe no CasaAngola (vale 60 minutos): '.$link) }}">Enviar por WhatsApp para +{{ $n }}</a></p>
@endforeach
<p class="sm"><a href="/admin/utilizadores">Voltar aos utilizadores</a></p>
@endsection
