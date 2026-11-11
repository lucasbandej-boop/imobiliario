document.addEventListener('DOMContentLoaded', () => {
  const input = document.querySelector('input[type=file]');
  if (!input) return;
  input.addEventListener('change', async () => {
    const dt = new DataTransfer();
    for (const f of input.files) {
      try {
        const bmp = await createImageBitmap(f);
        const s = Math.min(1, 1280 / Math.max(bmp.width, bmp.height));
        const c = document.createElement('canvas');
        c.width = Math.round(bmp.width * s);
        c.height = Math.round(bmp.height * s);
        c.getContext('2d').drawImage(bmp, 0, 0, c.width, c.height);
        const blob = await new Promise(r => c.toBlob(r, 'image/jpeg', 0.7));
        dt.items.add(new File([blob], f.name.replace(/\.\w+$/, '') + '.jpg', {type: 'image/jpeg'}));
      } catch (e) {
        dt.items.add(f);
      }
    }
    input.files = dt.files;
  });
});
