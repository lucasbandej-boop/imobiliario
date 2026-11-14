@extends('layout')
@section('titulo', 'Como funciona - CasaAngola')
@section('meta')
<meta property="og:type" content="website">
<meta property="og:site_name" content="CasaAngola">
<meta property="og:title" content="Como funciona o CasaAngola">
<meta property="og:description" content="Publique a sua casa ou terreno grátis e fale direto com quem procura, pelo WhatsApp.">
<meta name="description" content="Como publicar, contactar e ficar seguro no CasaAngola.">
@endsection
@section('conteudo')
<style>
.cf h1{font-size:1.5rem;margin:0 0 6px}
.cf h2{font-size:1.15rem;margin:24px 0 8px}
.cf ol,.cf ul{padding-left:20px}
.cf li{line-height:1.55;margin-bottom:6px}
.cf details{background:#fff;border-radius:10px;padding:10px 12px;margin-bottom:8px}
.cf summary{font-weight:600;cursor:pointer}
.cf details p{margin:8px 0 0;line-height:1.55}
</style>
<div class="cf">
<h1>Como funciona o CasaAngola</h1>
<p>O CasaAngola liga quem tem uma casa, apartamento ou terreno a quem procura. O dono publica o anúncio e fala diretamente com o cliente pelo WhatsApp, sem intermediários.</p>

<h2>Para quem tem um imóvel</h2>
<ol>
<li><b>Crie a sua conta</b> (é grátis) com nome, email e palavra-passe.</li>
<li>No <b>Painel</b>, toque em <b>Publicar anúncio</b>.</li>
<li><b>Preencha os dados:</b> título, se é para arrendar ou vender, tipo, preço em Kz ou em USD, província, município e bairro, quartos, casas de banho, descrição e o seu número de WhatsApp.</li>
<li><b>Junte até 5 fotos</b> do imóvel. O site reduz o tamanho sozinho para carregar depressa.</li>
<li><b>Publique.</b> O anúncio aparece logo na lista e dura 30 dias.</li>
<li>Quando o negócio estiver fechado, marque o anúncio como <b>arrendado</b> ou <b>vendido</b> no Painel.</li>
</ol>
<p>No Painel pode também <b>editar</b> o anúncio, <b>renovar por mais 30 dias</b> e ver as <b>estatísticas</b> (quantas pessoas viram e quantas tocaram no WhatsApp).</p>
<p><a class="btn" href="/anuncios/novo">Publicar o meu anúncio</a></p>

<h2>Para quem procura</h2>
<ol>
<li>Na página inicial, pesquise por bairro, município ou título, e filtre por arrendar ou vender, tipo, província, moeda e preço máximo.</li>
<li>Abra o anúncio para ver as fotos, o preço e a descrição.</li>
<li>Toque em <b>Contactar via WhatsApp</b> para falar diretamente com o dono.</li>
</ol>

<h2>Proprietário verificado</h2>
<p>Alguns donos têm o selo <b>✓ Proprietário verificado</b>. Significa que falámos com a pessoa e fizemos uma verificação básica. Não é uma garantia legal. Para pedir o selo, toque em <b>Pedir selo de verificado</b> no seu Painel.</p>

<h2>Compre e arrende em segurança</h2>
<ul>
<li>Visite o imóvel antes de pagar qualquer valor.</li>
<li>Confirme que a pessoa é mesmo o dono ou que tem autorização dele.</li>
<li>Não pague adiantado sem recibo e contrato escrito.</li>
<li>Desconfie de preços muito abaixo do normal e de quem tem pressa em receber dinheiro.</li>
<li>Viu algo suspeito? Toque em <b>Denunciar este anúncio</b>, no fim da página do anúncio.</li>
</ul>

<h2>Perguntas frequentes</h2>
<details><summary>Quanto custa publicar?</summary><p>Neste momento, publicar é grátis. Se isso mudar, avisamos antes.</p></details>
<details><summary>Quanto tempo fica o meu anúncio visível?</summary><p>30 dias. Depois sai da lista sozinho, e pode renová-lo no Painel por mais 30 dias.</p></details>
<details><summary>Posso anunciar uma casa que não é minha?</summary><p>Só se o dono lhe deu autorização. Anúncios falsos ou sem autorização são removidos.</p></details>
<details><summary>Quantas fotos posso pôr?</summary><p>Até 5 fotos por anúncio.</p></details>
<details><summary>Quantos anúncios posso ter?</summary><p>Até 10 anúncios ativos ao mesmo tempo (30 com o selo de verificado) e até 5 anúncios novos por dia.</p></details>
<details><summary>Posso pôr o preço em dólares?</summary><p>Sim. Ao publicar, escolha Kz ou USD.</p></details>
<details><summary>O CasaAngola cobra comissão ou participa no negócio?</summary><p>Não. As visitas, o preço, o contrato e o pagamento são combinados diretamente entre as pessoas.</p></details>
<details><summary>Esqueci a palavra-passe. O que faço?</summary><p>Na página Entrar, toque em <b>Esqueci a palavra-passe</b> e escreva o seu email. Abre-se o WhatsApp com uma mensagem para nós. Depois de confirmarmos que a conta é sua, enviamos um link para escolher uma nova palavra-passe. O link vale 60 minutos.</p></details>
<details><summary>O meu anúncio desapareceu da lista. Porquê?</summary><p>Pode ter expirado (30 dias), ter sido marcado como arrendado ou vendido, ou ter sido suspenso por uma denúncia. Veja o estado no Painel. Se expirou, toque em <b>Renovar 30 dias</b>. Se foi suspenso, fale connosco.</p></details>
<details><summary>Os meus dados ficam públicos?</summary><p>Só o que escreve no anúncio, incluindo o número de WhatsApp e as fotos. O nome e o email da conta não aparecem. Veja a <a href="/privacidade">Política de Privacidade</a>.</p></details>
<details><summary>Como apago o meu anúncio ou a minha conta?</summary><p>O anúncio apaga-se no Painel, no botão <b>Apagar</b>. Para apagar a conta, peça-nos pelo WhatsApp.</p></details>

<h2>Ainda tem dúvidas?</h2>
<p>Fale connosco no WhatsApp: <a href="https://wa.me/{{ config('site.admin_whatsapp') }}">+{{ config('site.admin_whatsapp') }}</a></p>
<p class="sm"><a href="/termos">Termos de Uso</a> · <a href="/privacidade">Política de Privacidade</a></p>
</div>
@endsection
