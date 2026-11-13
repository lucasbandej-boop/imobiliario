@extends('layout')
@section('titulo', 'Administração - Utilizadores')
@section('conteudo')
@include('admin._menu')
<h2>Utilizadores</h2>
<form class="filtros" method="GET" action="/admin/utilizadores">
  <input name="q" style="grid-column:1/-1" placeholder="Nome ou email" value="{{ request('q') }}">
  <button class="btn">Pesquisar</button>
</form>
@foreach($errors->all() as $e)<p class="erro">{{ $e }}</p>@endforeach
<p class="sm">{{ $utilizadores->total() }} utilizador(es)</p>
@foreach($utilizadores as $u)
<div class="card">
  <b>{{ $u->name }}</b> <span class="sm">#{{ $u->id }}</span>
  <div class="sm">{{ $u->email }}</div>
  <div class="sm">{{ $u->anuncios_total }} anúncio(s) · conta criada em {{ $u->created_at->copy()->setTimezone('Africa/Luanda')->format('d/m/Y') }}</div>
  <div style="margin-top:6px">
    @if($u->admin)<span class="bd">admin</span>@endif
    @if($u->verificado)<span class="bd ok">✓ verificado</span>@endif
    @if($u->bloqueado)<span class="bd mau">bloqueado</span>@endif
  </div>
  <div class="acoes">
    <form class="inline" method="POST" action="/admin/utilizadores/{{ $u->id }}/selo">@csrf<button class="mini">{{ $u->verificado ? 'Tirar selo' : 'Dar selo' }}</button></form>
    <form class="inline" method="POST" action="/admin/utilizadores/{{ $u->id }}/senha">@csrf<button class="mini">Link de nova palavra-passe</button></form>
    @if(!$u->admin)
      <form class="inline" method="POST" action="/admin/utilizadores/{{ $u->id }}/bloquear" onsubmit="return confirm('Confirmar esta ação?')">@csrf<button class="mini">{{ $u->bloqueado ? 'Desbloquear' : 'Bloquear' }}</button></form>
    @endif
  </div>
</div>
@endforeach
{{ $utilizadores->links() }}
@endsection
