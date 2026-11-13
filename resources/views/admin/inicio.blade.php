@extends('layout')
@section('titulo', 'Administração')
@section('conteudo')
@include('admin._menu')
<h2>Resumo</h2>
<div class="cx">
  <div><div class="num">{{ $utilizadores }}</div><div class="sm">Utilizadores</div></div>
  <div><div class="num">{{ $verificados }}</div><div class="sm">Verificados</div></div>
  <div><div class="num">{{ $ativos }}</div><div class="sm">Anúncios ativos</div></div>
  <div><div class="num">{{ $expirados }}</div><div class="sm">Expirados</div></div>
  <div><div class="num">{{ $suspensos }}</div><div class="sm">Suspensos</div></div>
  <div><div class="num">{{ $fechados }}</div><div class="sm">Arrendados ou vendidos</div></div>
</div>
<h3>Últimos anúncios</h3>
@foreach($ultimos as $a)
  <a class="card" href="/anuncio/{{ $a->id }}">
    <b>#{{ $a->id }} {{ $a->titulo }}</b>
    <div class="sm">{{ $a->precoTexto() }} · {{ $a->estado }} · {{ $a->publicadoTexto() }}</div>
  </a>
@endforeach
<h3>Últimos utilizadores</h3>
@foreach($novos as $u)
  <div class="card"><b>{{ $u->name }}</b><div class="sm">{{ $u->email }} · {{ $u->created_at->copy()->setTimezone('Africa/Luanda')->format('d/m/Y H:i') }}</div></div>
@endforeach
@endsection
