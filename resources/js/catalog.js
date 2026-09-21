document.addEventListener('DOMContentLoaded', () => {

    const products = JSON.parse(document.getElementById('products-data').textContent);
    const total    = products.length;
    let current    = 0;
    let animating  = false;

    const bgEl      = document.getElementById('catalog-bg');
    const circleEl  = document.getElementById('prod-circle');
    const catLeft   = document.querySelector('.cat-left');
    const tagEl     = document.getElementById('prod-tag');
    const titleEl   = document.getElementById('prod-title');
    const priceEl   = document.getElementById('prod-price');
    const descEl    = document.getElementById('prod-desc');
    const ingEl     = document.getElementById('prod-ing-list');
    const imgEl     = document.getElementById('prod-img');
    const emojiEl   = document.getElementById('prod-emoji');
    const thumbs    = document.querySelectorAll('.prod-thumb');
    const dots      = document.querySelectorAll('.dot');
    const curNumEl  = document.getElementById('cur-num');
    const btnPrev   = document.getElementById('btn-prev');
    const btnNext   = document.getElementById('btn-next');

    function apply(p) {
        bgEl.style.background     = p.bgGradient;
        circleEl.style.background = p.circleColor;

        tagEl.textContent   = p.tag;
        titleEl.textContent = p.name;
        priceEl.textContent = p.precio;       
        descEl.textContent  = p.desc;

        ingEl.innerHTML = p.ingredientes
            .map(i => `<li>${i}</li>`)
            .join('');

        imgEl.src = `/imgs/catalog/${p.imagen}`;
        imgEl.alt = p.name;
        imgEl.style.display = '';
        if (emojiEl) emojiEl.style.display = 'none';

        /* Color de texto según fondo del producto */
        const color = p.textDark ? 'rgba(10,22,40,0.92)' : 'rgba(255,255,255,0.95)';
        catLeft.style.color = color;
        document.querySelector('.cat-right').style.color = color;
    }

    function updateIndicators() {
        dots.forEach((d, i)   => d.classList.toggle('active', i === current));
        thumbs.forEach((t, i) => t.classList.toggle('active', i === current));
        if (curNumEl) curNumEl.textContent = current + 1;
    }

    function goToProduct(idx) {
        if (animating || idx === current) return;
        animating = true;

        catLeft.classList.add('animating');
        if (imgEl) imgEl.classList.add('animating');

        setTimeout(() => {
            current = ((idx % total) + total) % total;
            apply(products[current]);
            updateIndicators();
            catLeft.classList.remove('animating');
            if (imgEl) imgEl.classList.remove('animating');
            animating = false;
        }, 320);
    }

    window.goTo = (idx) => goToProduct(idx);

    btnPrev?.addEventListener('click', () => goToProduct(current - 1));
    btnNext?.addEventListener('click', () => goToProduct(current + 1));

    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            goToProduct(parseInt(dot.getAttribute('data-index'), 10));
        });
    });

    let touchStartX = 0;
    document.querySelector('.catalog-page')?.addEventListener('touchstart', e => {
        touchStartX = e.touches[0].clientX;
    }, { passive: true });
    document.querySelector('.catalog-page')?.addEventListener('touchend', e => {
        const dx = e.changedTouches[0].clientX - touchStartX;
        if (Math.abs(dx) > 55) goToProduct(current + (dx < 0 ? 1 : -1));
    }, { passive: true });

    document.addEventListener('keydown', e => {
        if (e.key === 'ArrowRight') goToProduct(current + 1);
        if (e.key === 'ArrowLeft')  goToProduct(current - 1);
    });

    /* Autoplay — pausa en hover */
    let timer = setInterval(() => goToProduct(current + 1), 6000);
    document.querySelector('.catalog-page')?.addEventListener('mouseenter', () => clearInterval(timer));
    document.querySelector('.catalog-page')?.addEventListener('mouseleave', () => {
        timer = setInterval(() => goToProduct(current + 1), 6000);
    });

    window.catalogAddToCart = function () {
        const p = products[current];
        const precioNum = parseFloat(p.precio.replace(/\./g, '').replace(',', '.'));

        window.addToCart({
            producto_nombre : p.name,
            producto_imagen : p.imagen,
            producto_emoji  : '🪖',
            producto_bg     : p.bgGradient,
            precio          : precioNum,
        });

        const btn = document.getElementById('prod-cta');
        if (btn) {
            const orig = btn.innerHTML;
            btn.innerHTML = '✓ Agregado al carrito';
            btn.style.background = 'rgba(255,255,255,0.95)';
            btn.style.color      = 'var(--navy)';
            setTimeout(() => {
                btn.innerHTML        = orig;
                btn.style.background = '';
                btn.style.color      = '';
            }, 1800);
        }
    };

    /* Init */
    apply(products[0]);
    updateIndicators();
});