@extends('layout')
@section('titulo', $anuncio->titulo)
@section('conteudo')
@foreach($anuncio->fotos ?? [] as $f)
  <img src="{{ \App\Support\Fotos::url($f) }}" alt="" style="width:100%;border-radius:10px;margin-bottom:8px">
@endforeach
<h2>{{ $anuncio->titulo }}</h2>
<div class="preco">{{ number_format($anuncio->preco, 0, ',', '.') }} {{ $anuncio->moeda }}</div>
<p class="sm">{{ ucfirst($anuncio->tipo) }} para {{ $anuncio->finalidade }} · {{ $anuncio->bairro ? $anuncio->bairro.', ' : '' }}{{ $anuncio->municipio ? $anuncio->municipio.', ' : '' }}{{ $anuncio->provincia }}</p>
<p>{{ $anuncio->quartos !== null ? $anuncio->quartos.' quartos · ' : '' }}{{ $anuncio->casas_banho !== null ? $anuncio->casas_banho.' casas de banho' : '' }}</p>
<p>{!! nl2br(e($anuncio->descricao)) !!}</p>
@if($anuncio->estado !== 'ativo')<p class="erro"><b>Este anúncio já está {{ $anuncio->estado }}.</b></p>@endif
<a class="btn" style="display:block;text-align:center;text-decoration:none" href="https://wa.me/{{ $anuncio->whatsapp }}?text={{ urlencode('Olá, vi o anúncio "'.$anuncio->titulo.'" e tenho interesse.') }}">Contactar via WhatsApp</a>
@endsection
