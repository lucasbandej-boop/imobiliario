<style>
.adm-menu{display:flex;gap:8px;margin-bottom:14px;flex-wrap:wrap}
.adm-menu a{background:#fff;padding:8px 14px;border-radius:20px;text-decoration:none;color:var(--texto);font-size:.9rem}
.adm-menu a.on{background:var(--cor);color:#fff}
.bd{display:inline-block;font-size:.72rem;font-weight:700;padding:2px 8px;border-radius:20px;background:#e8eeec;color:var(--texto);margin-right:4px}
.bd.ok{background:#e3f4ee;color:var(--cor-escura)}
.bd.mau{background:#fde8e8;color:#a40000}
.acoes{display:flex;gap:6px;flex-wrap:wrap;margin-top:8px}
.num{font-size:1.4rem;font-weight:700;color:var(--cor)}
.cx{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:14px}
.cx>div{background:#fff;border-radius:12px;padding:12px}
</style>
<div class="adm-menu">
  <a href="/admin" class="{{ request()->is('admin') ? 'on' : '' }}">Resumo</a>
  <a href="/admin/anuncios" class="{{ request()->is('admin/anuncios*') ? 'on' : '' }}">Anúncios</a>
  <a href="/admin/utilizadores" class="{{ request()->is('admin/utilizadores*') ? 'on' : '' }}">Utilizadores</a>
</div>
