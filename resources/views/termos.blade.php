@extends('layout')
@section('titulo', 'Termos de Uso - CasaAngola')
@section('conteudo')
<style>.legal h2{font-size:1.1rem;margin:22px 0 6px}.legal p,.legal li{line-height:1.55}.legal ul{padding-left:20px}</style>
<div class="legal">
<h1>Termos de Uso</h1>
<p class="sm">Última actualização: 13 de Novembro de 2026</p>
<p>Estes Termos explicam as regras de utilização do CasaAngola. Ao criar uma conta ou publicar um anúncio, aceita estas regras.</p>

<h2>1. O que é o CasaAngola</h2>
<p>O CasaAngola é um site onde proprietários, e pessoas autorizadas por eles, publicam anúncios de casas, apartamentos e terrenos para arrendar ou vender em Angola. É apenas uma plataforma de divulgação. Não somos uma agência imobiliária, não somos parte nos negócios entre utilizadores e, neste momento, não cobramos comissões. A publicação de anúncios é gratuita; se isso mudar, avisaremos antes.</p>

<h2>2. A sua conta</h2>
<p>Para publicar precisa de uma conta. Deve ter 18 anos ou mais, dar informações verdadeiras e guardar a sua palavra-passe. É responsável por tudo o que for feito com a sua conta. Se achar que alguém a usou, avise-nos de imediato.</p>

<h2>3. Regras para os anúncios</h2>
<ul>
<li>Só publique imóveis que sejam seus ou que o dono lhe tenha autorizado a anunciar.</li>
<li>A informação (preço, localização, quartos, descrição) tem de ser verdadeira e actual. Marque o anúncio como arrendado ou vendido quando o negócio estiver fechado.</li>
<li>Use apenas fotos do próprio imóvel e que tenha direito de usar.</li>
<li>O número de WhatsApp deve ser seu ou de quem trata do anúncio. É mostrado a quem visita o anúncio.</li>
</ul>
<p>É proibido: anunciar imóveis que não existem ou que não pode arrendar ou vender; publicar anúncios enganosos ou repetidos; publicar conteúdo ilegal, ofensivo ou discriminatório; publicar dados pessoais de terceiros sem autorização; enviar spam; tentar aceder a contas ou áreas que não são suas.</p>

<h2>4. Duração dos anúncios</h2>
<p>Cada anúncio fica visível durante 30 dias. Depois sai da lista. Pode renová-lo no seu Painel por mais 30 dias.</p>

<h2>5. Selo de proprietário verificado</h2>
<p>O selo é atribuído por nós, manualmente, depois de contactarmos o proprietário. Indica que fizemos uma verificação básica. Não é uma garantia legal sobre o imóvel nem sobre a pessoa, e podemos retirá-lo em qualquer altura.</p>

<h2>6. Denúncias e moderação</h2>
<p>Pode denunciar um anúncio através do link "Denunciar este anúncio". Podemos esconder ou apagar anúncios, e suspender ou encerrar contas, que não cumpram estes Termos, sem aviso prévio em casos graves.</p>

<h2>7. Os negócios são entre as pessoas</h2>
<p>Visitas, preços, contratos e pagamentos são combinados directamente entre quem anuncia e quem procura. Não somos parte desses negócios e não garantimos que um anúncio é verdadeiro. Por segurança: confirme quem é o dono, visite o imóvel antes de pagar, não pague adiantado sem recibo e contrato escrito, e desconfie de preços muito abaixo do normal.</p>

<h2>8. Responsabilidade</h2>
<p>O CasaAngola é oferecido tal como está. Na medida permitida pela lei, não nos responsabilizamos pelos conteúdos publicados pelos utilizadores, por negócios feitos ou falhados, nem por falhas ou interrupções do serviço.</p>

<h2>9. Os seus conteúdos</h2>
<p>Os textos e as fotos continuam a ser seus. Ao publicar, autoriza-nos a mostrá-los no site e nas pré-visualizações de links partilhados, enquanto o anúncio existir. Garante que tem direito de os usar.</p>

<h2>10. Alterações a estes Termos</h2>
<p>Podemos alterar estes Termos. A data de actualização está no topo da página. Se continuar a usar o site depois de uma alteração, aceita os novos Termos.</p>

<h2>11. Lei aplicável</h2>
<p>Estes Termos regem-se pela lei da República de Angola. Qualquer conflito será levado aos tribunais de Luanda.</p>

<h2>12. Contactos</h2>
<p>Responsável: {{ config('legal.responsavel') }}, Luanda, Angola.<br>Email: {{ config('legal.contacto') }}<br>WhatsApp: +{{ config('site.admin_whatsapp') }}</p>
<p><a href="/privacidade">Ver a Política de Privacidade</a></p>
</div>
@endsection
