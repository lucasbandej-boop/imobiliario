document.addEventListener('DOMContentLoaded', () => {
  const input = document.querySelector('input[type=file]');
  if (!input) return;
  const MAX = 5;
  const botao = input.form.querySelector('button.btn');
  const aviso = document.createElement('div');
  aviso.className = 'sm';
  const prev = document.createElement('div');
  prev.style.cssText = 'display:flex;gap:6px;flex-wrap:wrap';
  input.after(aviso, prev);

  input.addEventListener('change', async () => {
    let lista = Array.from(input.files);
    prev.innerHTML = '';
    if (!lista.length) { aviso.textContent = ''; return; }
    let corte = '';
    if (lista.length > MAX) { lista = lista.slice(0, MAX); corte = ' (máximo ' + MAX + ')'; }
    botao.disabled = true;
    aviso.textContent = 'A preparar as fotos...';
    const dt = new DataTransfer();
    for (const f of lista) {
      let ficheiro = f;
      try {
        const bmp = await createImageBitmap(f);
        const s = Math.min(1, 1280 / Math.max(bmp.width, bmp.height));
        const c = document.createElement('canvas');
        c.width = Math.round(bmp.width * s);
        c.height = Math.round(bmp.height * s);
        c.getContext('2d').drawImage(bmp, 0, 0, c.width, c.height);
        const blob = await new Promise(r => c.toBlob(r, 'image/jpeg', 0.7));
        ficheiro = new File([blob], f.name.replace(/\.\w+$/, '') + '.jpg', { type: 'image/jpeg' });
      } catch (e) {}
      dt.items.add(ficheiro);
      const im = document.createElement('img');
      im.src = URL.createObjectURL(ficheiro);
      im.style.cssText = 'width:64px;height:64px;object-fit:cover;border-radius:8px';
      prev.appendChild(im);
    }
    input.files = dt.files;
    aviso.textContent = dt.files.length + ' foto(s) pronta(s)' + corte;
    botao.disabled = false;
  });
});
