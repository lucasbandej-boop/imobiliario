@extends('layout')
@section('titulo', 'Esqueci a palavra-passe')
@section('conteudo')
<h2>Esqueci a palavra-passe</h2>
<form onsubmit="return false">
  <p class="sm" style="margin:0">Escreva o email da sua conta e peça um link de nova palavra-passe pelo WhatsApp. Respondemos assim que possível.</p>
  <input id="email" type="email" placeholder="O seu email">
  <button class="btn" type="button" onclick="pedir()">Pedir link pelo WhatsApp</button>
</form>
<p class="sm" style="text-align:center;margin-top:12px"><a href="/entrar">Voltar a entrar</a></p>
<script>
function pedir() {
  var e = document.getElementById('email').value.trim();
  if (!e) { alert('Escreva o seu email.'); return; }
  var msg = 'Olá! Esqueci a palavra-passe do CasaAngola. Email da conta: ' + e;
  window.location.href = 'https://wa.me/{{ config('site.admin_whatsapp') }}?text=' + encodeURIComponent(msg);
}
</script>
@endsection
