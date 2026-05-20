document.addEventListener('DOMContentLoaded', () => {

    /* ── Sidebar toggle ───────────────────────────────────── */
    const menuContainer = document.getElementById('menu');
    const menuIcon      = document.getElementById('menu-icon');
    const sidebar       = document.getElementById('sidebar');
    const main          = document.getElementById('main');

    function toggleSidebar() {
        if (!menuIcon || !sidebar || !main) return;
        menuIcon.classList.toggle('menu-toggle');
        sidebar.classList.toggle('menu-toggle');
        main.classList.toggle('menu-toggle');
        if (window.innerWidth <= 600) {
            document.body.style.overflow =
                sidebar.classList.contains('menu-toggle') ? 'hidden' : '';
        }
    }

    if (menuContainer) {
        menuContainer.addEventListener('click', toggleSidebar);
        menuContainer.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); toggleSidebar(); }
        });
    }

    document.addEventListener('click', (e) => {
        if (window.innerWidth > 600) return;
        if (!sidebar) return;
        if (!sidebar.contains(e.target) && !menuContainer.contains(e.target)
            && sidebar.classList.contains('menu-toggle')) {
            toggleSidebar();
        }
    });

    function initReveal() {
        const revealEls = document.querySelectorAll('[data-reveal]');

        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

            revealEls.forEach(el => observer.observe(el));
        } else {

            revealEls.forEach(el => el.classList.add('revealed'));
        }


        revealEls.forEach(el => {
            const rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight * 0.95) {
                el.classList.add('revealed');
            }
        });
    }

    initReveal();
});