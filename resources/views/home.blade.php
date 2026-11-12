@extends('layout')
@section('conteudo')
<section class="hero">
  <h1>Arrende ou venda a sua casa, direto com o cliente</h1>
  <p>Casas, apartamentos e terrenos em Angola. Sem intermediários.</p>
  <div class="hero-btns">
    <a class="btn btn-amarelo" href="/anuncios/novo">Publicar anúncio</a>
    <a class="btn btn-claro" href="#lista">Procurar</a>
  </div>
</section>

<form class="filtros" method="GET" action="/#lista">
  <select name="finalidade">
    <option value="">Arrendar ou vender</option>
    <option value="arrendar" @selected(request('finalidade')=='arrendar')>Arrendar</option>
    <option value="vender" @selected(request('finalidade')=='vender')>Vender</option>
  </select>
  <select name="tipo">
    <option value="">Todos os tipos</option>
    @foreach(['casa','apartamento','terreno'] as $t)
      <option value="{{ $t }}" @selected(request('tipo')==$t)>{{ ucfirst($t) }}</option>
    @endforeach
  </select>
  <select name="provincia">
    <option value="">Todas as províncias</option>
    @foreach($provincias as $p)
      <option @selected(request('provincia')==$p)>{{ $p }}</option>
    @endforeach
  </select>
  <button class="btn">Filtrar</button>
</form>

<h2 id="lista">Anúncios recentes</h2>
<div class="grid">
@forelse($anuncios as $a)
  <a class="ad" href="/anuncio/{{ $a->id }}">
    <div class="foto">
      @if($a->fotos)
        <img src="{{ \App\Support\Fotos::url($a->fotos[0]) }}" alt="" loading="lazy">
      @else
        <div class="sem-foto">Sem foto</div>
      @endif
      <span class="tag {{ $a->finalidade }}">{{ $a->finalidade == 'vender' ? 'Venda' : 'Arrendar' }}</span>
    </div>
    <div class="info">
      <div class="preco">{{ number_format($a->preco, 0, ',', '.') }} {{ $a->moeda }}</div>
      <b>{{ $a->titulo }}</b>
      <div class="sm">{{ $a->bairro ? $a->bairro.', ' : '' }}{{ $a->provincia }}</div>
      <div class="sm">{{ ucfirst($a->tipo) }}{{ $a->quartos !== null ? ' · '.$a->quartos.' quartos' : '' }}</div>
    </div>
  </a>
@empty
  <p>Ainda não há anúncios. Seja o primeiro a publicar!</p>
@endforelse
</div>
{{ $anuncios->links() }}
@endsection
