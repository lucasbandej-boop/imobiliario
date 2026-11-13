<!doctype html>
<html lang="pt">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#0e7c66">
<link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' rx='8' fill='%23f2a900'/%3E%3Cpath d='M16 7 6 15h3v9h5v-6h4v6h5v-9h3z' fill='white'/%3E%3C/svg%3E">
<title>@yield('titulo', 'CasaAngola - Casas e terrenos em Angola')</title>
@hasSection('meta')
@yield('meta')
@else
<meta property="og:type" content="website">
<meta property="og:site_name" content="CasaAngola">
<meta property="og:title" content="CasaAngola - Casas e terrenos em Angola">
<meta property="og:description" content="Arrende ou venda a sua casa direto com o cliente, sem intermediários.">
<meta name="description" content="Casas, apartamentos e terrenos para arrendar ou vender em Angola, direto com o dono.">
@endif
<style>
:root{--cor:#0e7c66;--cor-escura:#0a5c4c;--destaque:#f2a900;--fundo:#f4f6f5;--texto:#1d2b27;--cinza:#6b7873}
*{box-sizing:border-box}
body{font-family:system-ui,sans-serif;margin:0;background:var(--fundo);color:var(--texto)}
nav{background:var(--cor);color:#fff;padding:12px 16px;display:flex;gap:14px;align-items:center;flex-wrap:wrap}
nav a,nav button{color:#fff;text-decoration:none;background:none;border:0;font-size:1rem;cursor:pointer;padding:0;font-family:inherit}
nav .logo{margin-right:auto;display:flex;align-items:center;gap:8px;font-weight:700;font-size:1.2rem}
nav .pub{background:var(--destaque);color:#1d2b27;padding:6px 12px;border-radius:20px;font-weight:700;font-size:.9rem}
main{max-width:720px;margin:20px auto;padding:0 16px}
form{background:#fff;padding:16px;border-radius:12px;display:grid;gap:10px}
form.inline{display:inline;padding:0;background:none}
input,select,textarea{padding:12px;border:1px solid #cdd6d3;border-radius:8px;font-size:1rem;width:100%;font-family:inherit;background:#fff;color:var(--texto)}
.btn{background:var(--cor);color:#fff;border:0;padding:12px 18px;border-radius:8px;font-size:1rem;cursor:pointer;font-weight:600}
a.btn{display:inline-block;text-decoration:none;text-align:center}
.erro{color:#c00;font-size:.9rem;margin:0}
.card{background:#fff;border-radius:12px;padding:12px;margin-bottom:12px;display:block;color:inherit;text-decoration:none}
.card img{width:100%;border-radius:8px;max-height:200px;object-fit:cover}
.preco{color:var(--cor);font-weight:700;font-size:1.1rem}
.sm{font-size:.85rem;color:var(--cinza)}
.mini{background:#e8eeec;border:0;padding:6px 10px;border-radius:6px;cursor:pointer}
.hero{background:linear-gradient(135deg,var(--cor),var(--cor-escura));color:#fff;border-radius:14px;padding:26px 18px;margin-bottom:16px}
.hero h1{font-size:1.5rem;line-height:1.25;margin:0 0 8px}
.hero p{margin:0 0 16px;opacity:.9}
.hero-btns{display:flex;gap:10px;flex-wrap:wrap}
.btn-amarelo{background:var(--destaque);color:#1d2b27}
.btn-claro{background:rgba(255,255,255,.2);color:#fff}
.filtros{grid-template-columns:1fr 1fr;margin-bottom:18px}
.filtros select:nth-of-type(3),.filtros button{grid-column:1/-1}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:12px}
.ad{background:#fff;border-radius:12px;overflow:hidden;color:inherit;text-decoration:none;display:block;box-shadow:0 1px 3px rgba(0,0,0,.08)}
.foto{position:relative;height:170px;background:#dde5e2}
.foto img{width:100%;height:100%;object-fit:cover;display:block}
.sem-foto{height:100%;display:flex;align-items:center;justify-content:center;color:var(--cinza)}
.tag{position:absolute;top:10px;left:10px;background:var(--destaque);color:#1d2b27;font-size:.75rem;font-weight:700;padding:4px 10px;border-radius:20px}
.tag.vender{background:#fff}
.info{padding:12px;display:grid;gap:3px}
nav[role=navigation] svg{width:16px;height:16px}
footer{text-align:center;color:var(--cinza);font-size:.85rem;padding:24px 16px}
</style>
</head>
<body>
<nav>
  <a class="logo" href="/">
    <svg width="30" height="30" viewBox="0 0 32 32" aria-hidden="true"><rect width="32" height="32" rx="8" fill="#f2a900"/><path d="M16 7 6 15h3v9h5v-6h4v6h5v-9h3z" fill="#fff"/></svg>
    CasaAngola
  </a>
  <a class="pub" href="/anuncios/novo">Publicar</a>
  @auth
    <a href="/painel">Painel</a>
    <form class="inline" method="POST" action="/sair">@csrf<button>Sair</button></form>
  @else
    <a href="/entrar">Entrar</a><a href="/registo">Criar conta</a>
  @endauth
</nav>
<main>@yield('conteudo')</main>
<footer>CasaAngola · Proprietários e clientes, sem intermediários · Angola</footer>
</body>
</html>
