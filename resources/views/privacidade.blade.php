@extends('layout')
@section('titulo', 'Política de Privacidade - CasaAngola')
@section('conteudo')
<style>.legal h2{font-size:1.1rem;margin:22px 0 6px}.legal p,.legal li{line-height:1.55}.legal ul{padding-left:20px}</style>
<div class="legal">
<h1>Política de Privacidade</h1>
<p class="sm">Última actualização: 13 de Novembro de 2026</p>
<p>Esta política explica que dados pessoais recolhemos no CasaAngola, para que os usamos e quais são os seus direitos, de acordo com a Lei da Protecção de Dados Pessoais de Angola (Lei n.º 22/11, de 17 de Junho).</p>

<h2>1. Quem é o responsável</h2>
<p>{{ config('legal.responsavel') }}, Luanda, Angola. Email: {{ config('legal.contacto') }}. WhatsApp: +{{ config('site.admin_whatsapp') }}.</p>

<h2>2. Que dados recolhemos</h2>
<ul>
<li><b>Conta:</b> nome, email e palavra-passe (guardada de forma cifrada).</li>
<li><b>Anúncios:</b> título, descrição, preço, localização, número de WhatsApp, fotos e as datas de publicação.</li>
<li><b>Dados técnicos:</b> registos do servidor, como endereço IP, tipo de aparelho e páginas visitadas, mantidos pelo serviço de alojamento.</li>
<li><b>Verificação:</b> para o selo de verificado podemos contactá-lo por WhatsApp. Não guardamos cópias de documentos de identificação.</li>
</ul>

<h2>3. Para que usamos os dados</h2>
<p>Para criar e gerir a sua conta, publicar e mostrar os seus anúncios, permitir que interessados o contactem, recuperar o acesso à conta, moderar denúncias, prevenir fraude, manter o site seguro e cumprir obrigações legais.</p>

<h2>4. O que é público</h2>
<p>Tudo o que escreve num anúncio, incluindo o número de WhatsApp e as fotos, é visível para qualquer visitante e pode ser copiado ou partilhado por outras pessoas. Não ponha nos anúncios dados que não quer tornar públicos. O nome e o email da sua conta não são mostrados nos anúncios.</p>

<h2>5. Com quem partilhamos</h2>
<p>Não vendemos os seus dados. Usamos prestadores técnicos para o site funcionar:</p>
<ul>
<li>Render: alojamento do site.</li>
<li>Supabase: base de dados e armazenamento das fotos.</li>
<li>WhatsApp (Meta): quando toca em "Contactar via WhatsApp", "Pedir selo" ou "Denunciar", abre-se o WhatsApp no seu telemóvel e a conversa fica sujeita às regras do WhatsApp.</li>
</ul>
<p>Podemos ainda comunicar dados a autoridades quando a lei o exigir.</p>

<h2>6. Servidores fora de Angola</h2>
<p>Os prestadores acima usam servidores fora de Angola, nomeadamente na Europa. Ao usar o CasaAngola, os seus dados podem ser tratados nesses servidores.</p>

<h2>7. Cookies</h2>
<p>Usamos apenas cookies essenciais: um cookie de sessão, para o manter com a sessão iniciada, e um cookie de segurança contra pedidos falsos. Não usamos cookies de publicidade nem de análise.</p>

<h2>8. Quanto tempo guardamos</h2>
<p>Guardamos os dados da conta enquanto ela existir. Ao apagar um anúncio, ele deixa de ser mostrado no site; as fotos podem permanecer algum tempo no armazenamento técnico até serem eliminadas. Os registos técnicos são mantidos pelo serviço de alojamento durante o tempo que ele definir.</p>

<h2>9. Segurança</h2>
<p>A ligação ao site é protegida (https), as palavras-passe são guardadas de forma cifrada e o acesso à administração é restrito. Nenhum sistema é totalmente seguro, por isso proteja a sua palavra-passe.</p>

<h2>10. Os seus direitos</h2>
<p>Pode pedir para consultar, corrigir ou apagar os seus dados, ou opor-se ao seu tratamento, através dos contactos acima. Respondemos o mais depressa possível. Pode também apresentar queixa à Agência de Protecção de Dados (APD).</p>

<h2>11. Menores</h2>
<p>O CasaAngola destina-se a maiores de 18 anos.</p>

<h2>12. Alterações</h2>
<p>Podemos actualizar esta política. A data de actualização está no topo da página.</p>
<p><a href="/termos">Ver os Termos de Uso</a></p>
</div>
@endsection
