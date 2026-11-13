@extends('layout')
@section('titulo', 'Novo anúncio')
@section('conteudo')
<h2>Publicar anúncio</h2>
<form method="POST" action="/anuncios" enctype="multipart/form-data">
  @csrf
  <input name="titulo" placeholder="Título (ex: Casa T3 com quintal)" value="{{ old('titulo') }}">
  <select name="finalidade">
    <option value="arrendar">Arrendar</option>
    <option value="vender">Vender</option>
  </select>
  <select name="tipo">
    <option value="casa">Casa</option>
    <option value="apartamento">Apartamento</option>
    <option value="terreno">Terreno</option>
  </select>
  <input name="preco" type="number" placeholder="Preço" value="{{ old('preco') }}">
  <select name="moeda"><option value="AOA">Kz (Kwanzas)</option><option value="USD" @selected(old("moeda")=="USD")>USD (dólares)</option></select>
  <input name="provincia" list="provs" placeholder="Província" value="{{ old('provincia') }}">
  <datalist id="provs">
    @foreach(['Luanda','Benguela','Huambo','Huíla','Cabinda','Bengo','Bié','Cuanza Norte','Cuanza Sul','Cunene','Lunda Norte','Lunda Sul','Malanje','Moxico','Namibe','Uíge','Zaire'] as $p)<option value="{{ $p }}">@endforeach
  </datalist>
  <input name="municipio" placeholder="Município" value="{{ old('municipio') }}">
  <input name="bairro" placeholder="Bairro" value="{{ old('bairro') }}">
  <input name="quartos" type="number" placeholder="Quartos" value="{{ old('quartos') }}">
  <input name="casas_banho" type="number" placeholder="Casas de banho" value="{{ old('casas_banho') }}">
  <textarea name="descricao" rows="4" placeholder="Descrição">{{ old('descricao') }}</textarea>
  <input name="whatsapp" type="tel" placeholder="WhatsApp (ex: 923000000)" value="{{ old('whatsapp') }}">
  <label class="sm">Fotos (até 5; pode escolher várias de uma vez)</label>
  <input name="fotos[]" type="file" accept="image/*" multiple>
  @foreach($errors->all() as $e)<p class="erro">{{ $e }}</p>@endforeach
  <button class="btn">Publicar</button>
</form>
<script src="/comprimir.js?v=2"></script>
@endsection
