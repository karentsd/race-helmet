
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('search-input');
    const form = document.getElementById('filter-form');
    if (searchInput && form) {
        let timer;
        searchInput.addEventListener('input', () => {
            clearTimeout(timer);
            timer = setTimeout(() => form.submit(), 650);
        });
    }
});

function toggleComentario(btn) {
    const td   = btn.closest('td');
    const span = td.querySelector('.comentario-text');
    const full = span.getAttribute('data-full');
    if (btn.textContent === 'ver más') {
        span.textContent = full;
        btn.textContent  = 'ver menos';
    } else {
        span.textContent = full.length > 70 ? full.substring(0, 70) + '...' : full;
        btn.textContent  = 'ver más';
    }
}