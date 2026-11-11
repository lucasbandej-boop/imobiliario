@extends('layout')
@section('titulo', 'Painel')
@section('conteudo')
<h2>Olá, {{ auth()->user()->name }}</h2>
<a class="btn" style="display:block;text-align:center;text-decoration:none;margin-bottom:16px" href="/anuncios/novo">+ Publicar anúncio</a>
@forelse($anuncios as $a)
  <div class="card">
    <a href="/anuncio/{{ $a->id }}"><b>{{ $a->titulo }}</b></a>
    <div class="sm">{{ ucfirst($a->tipo) }} para {{ $a->finalidade }} · Estado: {{ $a->estado }}</div>
    <div style="margin-top:8px">
      <form class="inline" method="POST" action="/anuncios/{{ $a->id }}/estado">
        @csrf
        <input type="hidden" name="estado" value="{{ $a->finalidade == 'vender' ? 'vendido' : 'arrendado' }}">
        <button class="mini">Marcar {{ $a->finalidade == 'vender' ? 'vendido' : 'arrendado' }}</button>
      </form>
      <form class="inline" method="POST" action="/anuncios/{{ $a->id }}/estado">
        @csrf
        <input type="hidden" name="estado" value="ativo">
        <button class="mini">Reactivar</button>
      </form>
      <form class="inline" method="POST" action="/anuncios/{{ $a->id }}" onsubmit="return confirm('Apagar este anúncio?')">
        @csrf @method('DELETE')
        <button class="mini">Apagar</button>
      </form>
    </div>
  </div>
@empty
  <p>Ainda não publicou nenhum anúncio.</p>
@endforelse
@endsection
