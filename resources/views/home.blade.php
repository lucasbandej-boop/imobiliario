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
  <input name="q" style="grid-column:1/-1" placeholder="Procurar por bairro, município ou título" value="{{ request('q') }}">
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
  <select name="ordem">
    <option value="">Mais recentes</option>
    <option value="preco_asc" @selected(request('ordem')=='preco_asc')>Preço: mais barato</option>
    <option value="preco_desc" @selected(request('ordem')=='preco_desc')>Preço: mais caro</option>
  </select>
  <select name="moeda">
    <option value="">Kz e USD</option>
    <option value="AOA" @selected(request('moeda')=='AOA')>Só Kz</option>
    <option value="USD" @selected(request('moeda')=='USD')>Só USD</option>
  </select>
  <input name="max" type="number" style="grid-column:1/-1" placeholder="Preço máximo (em Kz, ou na moeda escolhida)" value="{{ request('max') }}">
  <button class="btn">Pesquisar</button>
</form>

<h2 id="lista">Anúncios</h2>
@if(request()->hasAny(['q','finalidade','tipo','provincia','ordem','moeda','max']))
  <p class="sm">{{ $anuncios->total() }} resultado(s) · <a href="/">Limpar filtros</a></p>
@endif
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
      @if($a->user && $a->user->verificado)<span class="tag" style="left:auto;right:10px;background:#fff;color:var(--cor)">✓ Verificado</span>@endif
    </div>
    <div class="info">
      <div class="preco">{{ $a->precoTexto() }}</div>
      <b>{{ $a->titulo }}</b>
      <div class="sm">{{ $a->bairro ? $a->bairro.', ' : '' }}{{ $a->provincia }}</div>
      <div class="sm">{{ ucfirst($a->tipo) }}{{ $a->quartos !== null ? ' · '.$a->quartos.($a->quartos == 1 ? ' quarto' : ' quartos') : '' }}</div>
      <div class="sm">Publicado em {{ $a->publicadoTexto() }}</div>
    </div>
  </a>
@empty
  <p>Nenhum anúncio encontrado. Tente outro bairro ou limpe os filtros.</p>
@endforelse
</div>
{{ $anuncios->links() }}
@endsection
