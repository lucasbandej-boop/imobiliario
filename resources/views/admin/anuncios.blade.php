@extends('layout')
@section('titulo', 'Administração - Anúncios')
@section('conteudo')
@include('admin._menu')
<h2>Anúncios</h2>
<form class="filtros" method="GET" action="/admin/anuncios">
  <input name="q" style="grid-column:1/-1" placeholder="Número, título, bairro ou email do dono" value="{{ request('q') }}">
  <select name="estado" style="grid-column:1/-1">
    <option value="">Todos os estados</option>
    @foreach(['ativo','suspenso','arrendado','vendido'] as $e)
      <option value="{{ $e }}" @selected(request('estado')==$e)>{{ ucfirst($e) }}</option>
    @endforeach
  </select>
  <button class="btn">Pesquisar</button>
</form>
<p class="sm">{{ $anuncios->total() }} anúncio(s)</p>
@foreach($anuncios as $a)
<div class="card">
  <a href="/anuncio/{{ $a->id }}"><b>#{{ $a->id }} {{ $a->titulo }}</b></a>
  <div class="sm">{{ $a->precoTexto() }} · {{ $a->provincia }}{{ $a->bairro ? ', '.$a->bairro : '' }}</div>
  <div class="sm">Dono: {{ $a->user->name ?? '?' }} · {{ $a->user->email ?? '' }}</div>
  <div class="sm">Publicado em {{ $a->publicadoTexto() }} · {{ $a->expirado ? 'Expirou em' : 'Válido até' }} {{ $a->validoAteTexto() }}</div>
  <div style="margin-top:6px">
    <span class="bd {{ $a->estado == 'suspenso' ? 'mau' : ($a->estado == 'ativo' && !$a->expirado ? 'ok' : '') }}">{{ ($a->estado == 'ativo' && $a->expirado) ? 'expirado' : $a->estado }}</span>
    @if($a->user && $a->user->verificado)<span class="bd ok">✓ dono verificado</span>@endif
  </div>
  <div class="acoes">
    @if($a->estado == 'suspenso')
      <form class="inline" method="POST" action="/admin/anuncios/{{ $a->id }}/estado">@csrf<input type="hidden" name="estado" value="ativo"><button class="mini">Reactivar</button></form>
    @else
      <form class="inline" method="POST" action="/admin/anuncios/{{ $a->id }}/estado" onsubmit="return confirm('Suspender este anúncio?')">@csrf<input type="hidden" name="estado" value="suspenso"><button class="mini">Suspender</button></form>
    @endif
    <form class="inline" method="POST" action="/admin/anuncios/{{ $a->id }}" onsubmit="return confirm('Apagar este anúncio de vez?')">@csrf @method('DELETE')<button class="mini">Apagar</button></form>
  </div>
</div>
@endforeach
{{ $anuncios->links() }}
@endsection
