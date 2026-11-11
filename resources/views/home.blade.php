@extends('layout')
@section('conteudo')
<h2>Casas e terrenos em Angola</h2>
<form method="GET" action="/">
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
<br>
@forelse($anuncios as $a)
  <a class="card" href="/anuncio/{{ $a->id }}">
    @if($a->fotos)<img src="{{ \App\Support\Fotos::url($a->fotos[0]) }}" alt="">@endif
    <b>{{ $a->titulo }}</b>
    <div class="preco">{{ number_format($a->preco, 0, ',', '.') }} {{ $a->moeda }}</div>
    <div class="sm">{{ ucfirst($a->tipo) }} para {{ $a->finalidade }} · {{ $a->bairro ? $a->bairro.', ' : '' }}{{ $a->provincia }}</div>
  </a>
@empty
  <p>Ainda não há anúncios.</p>
@endforelse
{{ $anuncios->links() }}
@endsection
