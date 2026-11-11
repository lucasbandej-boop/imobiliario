<!doctype html>
<html lang="pt">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('titulo', 'Imobiliário')</title>
<style>
*{box-sizing:border-box}
body{font-family:system-ui,sans-serif;margin:0;background:#f5f6f8;color:#222}
nav{background:#0b5fff;color:#fff;padding:12px 16px;display:flex;gap:14px;align-items:center;flex-wrap:wrap}
nav a,nav button{color:#fff;text-decoration:none;background:none;border:0;font-size:1rem;cursor:pointer;padding:0}
nav .logo{font-weight:700;margin-right:auto}
main{max-width:480px;margin:20px auto;padding:0 16px}
form{background:#fff;padding:16px;border-radius:10px;display:grid;gap:10px}
input{padding:12px;border:1px solid #ccc;border-radius:8px;font-size:1rem;width:100%}
.btn{background:#0b5fff;color:#fff;border:0;padding:12px;border-radius:8px;font-size:1rem;cursor:pointer}
.erro{color:#c00;font-size:.9rem;margin:0}
select,textarea{padding:12px;border:1px solid #ccc;border-radius:8px;font-size:1rem;width:100%;font-family:inherit}
.card{background:#fff;border-radius:10px;padding:12px;margin-bottom:12px;display:block;color:inherit;text-decoration:none}
.card img{width:100%;border-radius:8px;max-height:200px;object-fit:cover}
.preco{color:#0b5fff;font-weight:700}
.sm{font-size:.85rem;color:#666}
form.inline{display:inline;padding:0;background:none}
.mini{background:#eee;border:0;padding:6px 10px;border-radius:6px;cursor:pointer}
</style>
</head>
<body>
<nav>
  <a class="logo" href="/">Imobiliário</a>
  @auth
    <a href="/painel">Painel</a>
    <form method="POST" action="/sair" style="display:inline;background:none;padding:0">@csrf<button>Sair</button></form>
  @else
    <a href="/entrar">Entrar</a>
    <a href="/registo">Criar conta</a>
  @endauth
</nav>
<main>@yield('conteudo')</main>
</body>
</html>
