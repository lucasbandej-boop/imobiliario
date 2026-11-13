@extends('layout')
@section('titulo', 'Editar anúncio')
@section('conteudo')
<h2>Editar anúncio</h2>
<form method="POST" action="/anuncios/{{ $anuncio->id }}" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <input name="titulo" placeholder="Título" value="{{ old('titulo', $anuncio->titulo) }}">
  <select name="finalidade">
    <option value="arrendar" @selected(old('finalidade', $anuncio->finalidade)=='arrendar')>Arrendar</option>
    <option value="vender" @selected(old('finalidade', $anuncio->finalidade)=='vender')>Vender</option>
  </select>
  <select name="tipo">
    @foreach(['casa'=>'Casa','apartamento'=>'Apartamento','terreno'=>'Terreno'] as $v => $n)
      <option value="{{ $v }}" @selected(old('tipo', $anuncio->tipo)==$v)>{{ $n }}</option>
    @endforeach
  </select>
  <input name="preco" type="number" placeholder="Preço" value="{{ old('preco', (int) $anuncio->preco) }}">
  <select name="moeda"><option value="AOA" @selected(old("moeda", $anuncio->moeda)=="AOA")>Kz (Kwanzas)</option><option value="USD" @selected(old("moeda", $anuncio->moeda)=="USD")>USD (dólares)</option></select>
  <input name="provincia" list="provs" placeholder="Província" value="{{ old('provincia', $anuncio->provincia) }}">
  <datalist id="provs">
    @foreach(['Luanda','Benguela','Huambo','Huíla','Cabinda','Bengo','Bié','Cuanza Norte','Cuanza Sul','Cunene','Lunda Norte','Lunda Sul','Malanje','Moxico','Namibe','Uíge','Zaire'] as $p)<option value="{{ $p }}">@endforeach
  </datalist>
  <input name="municipio" placeholder="Município" value="{{ old('municipio', $anuncio->municipio) }}">
  <input name="bairro" placeholder="Bairro" value="{{ old('bairro', $anuncio->bairro) }}">
  <input name="quartos" type="number" placeholder="Quartos" value="{{ old('quartos', $anuncio->quartos) }}">
  <input name="casas_banho" type="number" placeholder="Casas de banho" value="{{ old('casas_banho', $anuncio->casas_banho) }}">
  <textarea name="descricao" rows="4" placeholder="Descrição">{{ old('descricao', $anuncio->descricao) }}</textarea>
  <input name="whatsapp" type="tel" placeholder="WhatsApp" value="{{ old('whatsapp', $anuncio->whatsapp) }}">

  @if($anuncio->fotos)
    <label class="sm">Fotos atuais (marque as que quer remover)</label>
    <div style="display:flex;gap:8px;flex-wrap:wrap">
      @foreach($anuncio->fotos as $f)
        <label style="display:grid;gap:4px;justify-items:center;font-size:.8rem">
          <img src="{{ \App\Support\Fotos::url($f) }}" style="width:76px;height:76px;object-fit:cover;border-radius:8px" alt="">
          <span><input type="checkbox" name="remover[]" value="{{ $f }}" style="width:auto"> Remover</span>
        </label>
      @endforeach
    </div>
  @endif

  <label class="sm">Adicionar fotos (máximo 5 no total)</label>
  <input name="novas[]" type="file" accept="image/*" multiple>
  @foreach($errors->all() as $e)<p class="erro">{{ $e }}</p>@endforeach
  <button class="btn">Guardar alterações</button>
</form>
<script src="/comprimir.js?v=2"></script>
@endsection
