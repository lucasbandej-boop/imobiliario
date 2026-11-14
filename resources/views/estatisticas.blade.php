@extends('layout')
@section('titulo', 'Estatísticas')
@section('conteudo')
<h2>Estatísticas</h2>
<p><b>#{{ $anuncio->id }} {{ $anuncio->titulo }}</b></p>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:14px">
  <div style="background:#fff;border-radius:12px;padding:12px"><div style="font-size:1.4rem;font-weight:700;color:var(--cor)">{{ $totalVisitas }}</div><div class="sm">Visitas ao anúncio</div></div>
  <div style="background:#fff;border-radius:12px;padding:12px"><div style="font-size:1.4rem;font-weight:700;color:var(--cor)">{{ $totalContactos }}</div><div class="sm">Toques no WhatsApp</div></div>
</div>
<h3>Últimos 14 dias</h3>
<div class="card">
@foreach($dias as $dia => $n)
  <div style="display:flex;align-items:center;gap:8px;margin:6px 0;font-size:.85rem">
    <span style="width:44px">{{ \Carbon\Carbon::parse($dia)->format('d/m') }}</span>
    <span style="flex:1;background:#e8eeec;border-radius:6px;height:14px;overflow:hidden"><span style="display:block;height:100%;width:{{ round($n['visitas'] / $maximo * 100) }}%;background:var(--cor)"></span></span>
    <span style="width:70px;text-align:right">{{ $n['visitas'] }} · {{ $n['contactos'] }}</span>
  </div>
@endforeach
</div>
<p class="sm">Cada linha mostra visitas · toques no WhatsApp. Contamos 1 visita e 1 toque por pessoa e por anúncio em cada sessão, e não contamos as suas próprias visitas. As contagens começaram no dia em que esta função foi ativada.</p>
<p><a href="/painel">Voltar ao Painel</a></p>
@endsection
