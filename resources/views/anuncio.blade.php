@extends('layout')
@section('titulo', $anuncio->titulo)
@section('meta')
<meta property="og:type" content="website">
<meta property="og:site_name" content="CasaAngola">
<meta property="og:title" content="{{ $anuncio->titulo }} · {{ $anuncio->precoTexto() }}">
<meta property="og:description" content="{{ ucfirst($anuncio->tipo) }} para {{ $anuncio->finalidade }} em {{ $anuncio->bairro ? $anuncio->bairro.', ' : '' }}{{ $anuncio->provincia }}. Publicado no CasaAngola.">
<meta property="og:url" content="{{ url('/anuncio/'.$anuncio->id) }}">
<meta name="description" content="{{ $anuncio->titulo }} · {{ $anuncio->precoTexto() }} · {{ $anuncio->provincia }}">
@if($anuncio->fotos)
<meta property="og:image" content="{{ \App\Support\Fotos::url($anuncio->fotos[0]) }}">
<meta name="twitter:card" content="summary_large_image">
@endif
@endsection
@section('conteudo')
<style>
.gal{position:relative}
.gal-trilho{display:flex;overflow-x:auto;scroll-snap-type:x mandatory;border-radius:12px;scrollbar-width:none}
.gal-trilho::-webkit-scrollbar{display:none}
.gal-trilho img{flex:0 0 100%;width:100%;height:320px;object-fit:cover;scroll-snap-align:center;background:#dde5e2}
.gal-n{position:absolute;right:10px;bottom:10px;background:rgba(0,0,0,.6);color:#fff;font-size:.8rem;padding:3px 10px;border-radius:20px}
.gal-mini{display:flex;gap:6px;margin:8px 0 14px;overflow-x:auto}
.gal-mini img{width:64px;height:48px;object-fit:cover;border-radius:6px;cursor:pointer;opacity:.6;flex:0 0 auto}
.gal-mini img.on{opacity:1;outline:2px solid var(--cor)}
.selo{display:inline-block;background:#e3f4ee;color:var(--cor-escura);font-size:.8rem;font-weight:700;padding:4px 10px;border-radius:20px}
</style>

@php $fotos = $anuncio->fotos ?? []; @endphp
@if(count($fotos))
<div class="gal">
  <div class="gal-trilho" id="trilho">
    @foreach($fotos as $f)
      <img src="{{ \App\Support\Fotos::url($f) }}" alt="Foto {{ $loop->iteration }}">
    @endforeach
  </div>
  @if(count($fotos) > 1)<span class="gal-n" id="gal-n">1/{{ count($fotos) }}</span>@endif
</div>
@if(count($fotos) > 1)
<div class="gal-mini" id="mini">
  @foreach($fotos as $f)
    <img src="{{ \App\Support\Fotos::url($f) }}" class="{{ $loop->first ? 'on' : '' }}" alt="">
  @endforeach
</div>
@endif
@endif

<h2>{{ $anuncio->titulo }}</h2>
@if($anuncio->user && $anuncio->user->verificado)<p><span class="selo">✓ Proprietário verificado</span></p>@endif
<p class="sm">Publicado em {{ $anuncio->publicadoTexto() }} · Válido até {{ $anuncio->validoAteTexto() }}</p>
<div class="preco">{{ $anuncio->precoTexto() }}</div>
<p class="sm">{{ ucfirst($anuncio->tipo) }} para {{ $anuncio->finalidade }} · {{ $anuncio->bairro ? $anuncio->bairro.', ' : '' }}{{ $anuncio->municipio ? $anuncio->municipio.', ' : '' }}{{ $anuncio->provincia }}</p>
<p>{{ $anuncio->quartos !== null ? $anuncio->quartos.($anuncio->quartos == 1 ? ' quarto' : ' quartos') : '' }}{{ ($anuncio->quartos !== null && $anuncio->casas_banho !== null) ? ' · ' : '' }}{{ $anuncio->casas_banho !== null ? $anuncio->casas_banho.($anuncio->casas_banho == 1 ? ' casa de banho' : ' casas de banho') : '' }}</p>
<p>{!! nl2br(e($anuncio->descricao)) !!}</p>

@php
  $disponivel = $anuncio->estado === 'ativo' && !$anuncio->expirado;
  $aviso = match($anuncio->estado) {
    'arrendado' => 'Este anúncio já está arrendado.',
    'vendido' => 'Este anúncio já foi vendido.',
    'suspenso' => 'Este anúncio está indisponível.',
    default => 'Este anúncio expirou.',
  };
@endphp
@if($disponivel)
<a class="btn" style="display:block;text-align:center;text-decoration:none" href="/anuncio/{{ $anuncio->id }}/whatsapp" rel="nofollow">Contactar via WhatsApp</a>
@else
<p class="erro"><b>{{ $aviso }}</b></p>
@endif
<p class="sm" style="text-align:center;margin-top:14px"><a href="https://wa.me/{{ config('site.admin_whatsapp') }}?text={{ urlencode('Denúncia do anúncio #'.$anuncio->id.' ('.url('/anuncio/'.$anuncio->id).'). Motivo: ') }}">Denunciar este anúncio</a></p>

<script>
(function () {
  var t = document.getElementById('trilho');
  if (!t) return;
  var n = document.getElementById('gal-n');
  var minis = document.querySelectorAll('#mini img');
  t.addEventListener('scroll', function () {
    var i = Math.round(t.scrollLeft / t.clientWidth);
    if (n) n.textContent = (i + 1) + '/' + t.children.length;
    minis.forEach(function (m, k) { m.classList.toggle('on', k === i); });
  });
  minis.forEach(function (m, k) {
    m.addEventListener('click', function () {
      t.scrollTo({ left: k * t.clientWidth, behavior: 'smooth' });
    });
  });
})();
</script>
@endsection
