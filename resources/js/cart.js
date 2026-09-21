function getCsrf() {
    return document.querySelector('meta[name="csrf-token"]')?.content ?? '';
}
function apiHeaders() {
    return { 'Content-Type':'application/json', 'Accept':'application/json', 'X-CSRF-TOKEN':getCsrf() };
}
function fmtPrice(str) { return `$ ${str}`; }

function updateCartBadge(count) {
    const n = parseInt(count) || 0;
    document.querySelectorAll('.cart-nav-badge').forEach(b => {
        b.textContent = n;
        b.style.display = n > 0 ? 'flex' : 'none';
    });
}

window.updateQty = async function(id, delta) {
    const numEl    = document.getElementById(`qty-num-${id}`);
    const minusBtn = document.querySelector(`#item-${id} .qty-btn--minus`);
    const plusBtn  = document.querySelector(`#item-${id} .qty-btn--plus`);
    if (!numEl) return;
    const current = parseInt(numEl.textContent) || 1;
    const newQty  = current + delta;
    if (newQty < 1) return;
    if (minusBtn) minusBtn.disabled = true;
    if (plusBtn)  plusBtn.disabled  = true;
    try {
        const res  = await fetch(`/carrito/${id}`, { method:'PATCH', headers:apiHeaders(), body:JSON.stringify({cantidad:newQty}) });
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        const data = await res.json();
        if (data.success) {
            numEl.textContent = newQty;
            const subEl = document.getElementById(`sub-${id}`);
            if (subEl) subEl.textContent = fmtPrice(data.subtotal);
            const stEl = document.getElementById('summary-subtotal');
            const ttEl = document.getElementById('summary-total');
            if (stEl) stEl.textContent = fmtPrice(data.total);
            if (ttEl) ttEl.textContent = fmtPrice(data.total);
            updateCartBadge(data.cart_count);
        }
    } catch(err) { console.error('updateQty:', err); showToast('Error al actualizar.', true); }
    finally {
        const qty = parseInt(numEl.textContent) || 1;
        if (minusBtn) minusBtn.disabled = qty <= 1;
        if (plusBtn)  plusBtn.disabled  = false;
    }
};

window.removeItem = async function(id) {
    const itemEl = document.getElementById(`item-${id}`);
    if (!itemEl) return;
    itemEl.style.transition = 'opacity 0.25s ease, transform 0.25s ease';
    itemEl.style.opacity    = '0';
    itemEl.style.transform  = 'translateX(28px)';
    try {
        const res  = await fetch(`/carrito/${id}`, { method:'DELETE', headers:apiHeaders() });
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        const data = await res.json();
        if (data.success) {
            setTimeout(() => {
                itemEl.remove();
                const stEl = document.getElementById('summary-subtotal');
                const ttEl = document.getElementById('summary-total');
                if (stEl) stEl.textContent = fmtPrice(data.total);
                if (ttEl) ttEl.textContent = fmtPrice(data.total);
                updateCartBadge(data.cart_count);
                const list = document.getElementById('cart-items-list');
                if (list && list.querySelectorAll('.cart-item').length === 0) location.reload();
            }, 280);
        } else {
            itemEl.style.opacity = '1'; itemEl.style.transform = 'translateX(0)';
        }
    } catch(err) {
        console.error('removeItem:', err);
        itemEl.style.opacity = '1'; itemEl.style.transform = 'translateX(0)';
        showToast('Error al eliminar.', true);
    }
};

window.addToCart = async function(product) {
    try {
        const res  = await fetch('/carrito/agregar', { method:'POST', headers:apiHeaders(), body:JSON.stringify(product) });
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        const data = await res.json();
        if (data.success) { updateCartBadge(data.cart_count); showToast(data.message); }
    } catch(err) { console.error('addToCart:', err); showToast('Error al agregar.', true); }
};

function showToast(msg, isError = false) {
    const old = document.getElementById('rh-toast');
    if (old) old.remove();
    const t = document.createElement('div');
    t.id = 'rh-toast'; t.textContent = msg;
    Object.assign(t.style, {
        position:'fixed', bottom:'1.8rem', right:'1.8rem',
        background: isError ? '#7A1A1A' : '#0A1628',
        color:'#C9A84C', padding:'11px 20px', borderRadius:'6px',
        fontSize:'13px', fontWeight:'600', fontFamily:"'Inter',sans-serif",
        zIndex:'9999', boxShadow:'0 6px 24px rgba(0,0,0,0.28)',
        opacity:'1', transition:'opacity 0.28s ease',
    });
    document.body.appendChild(t);
    setTimeout(() => { t.style.opacity = '0'; setTimeout(() => t.remove(), 300); }, 2500);
}

document.addEventListener('DOMContentLoaded', () => {
    fetch('/carrito/count', { headers:{ 'Accept':'application/json' } })
        .then(r => r.json()).then(d => updateCartBadge(d.count ?? 0)).catch(() => {});
});