document.addEventListener('DOMContentLoaded', () => {

    /* Pills interactivas */
    document.querySelectorAll('.pill-group').forEach(group => {
        group.querySelectorAll('.pill-label').forEach(pill => {
            pill.addEventListener('click', () => {
                group.querySelectorAll('.pill-label').forEach(p => p.classList.remove('selected'));
                pill.classList.add('selected');
            });
        });
    });

    /* Contador de caracteres */
    const textarea = document.getElementById('comentario');
    const counter  = document.getElementById('char-counter');
    if (textarea && counter) {
        const update = () => {
            const len = Math.min(textarea.value.length, 1000);
            counter.textContent = `${len} / 1000 caracteres`;
            counter.style.color = len > 900 ? 'var(--gold)' : 'var(--text-muted)';
            if (textarea.value.length > 1000) textarea.value = textarea.value.slice(0, 1000);
        };
        textarea.addEventListener('input', update);
        update();
    }

    /* Validación antes de enviar */
    const form      = document.getElementById('pqrs-form');
    const submitBtn = document.getElementById('submit-btn');
    if (form && submitBtn) {
        form.addEventListener('submit', (e) => {
            let valid = true;
            form.querySelectorAll('.form-error--js').forEach(el => el.remove());
            form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

            ['nombres', 'apellidos', 'correo', 'comentario'].forEach(name => {
                const field = form.querySelector(`[name="${name}"]`);
                if (field && !field.value.trim()) {
                    field.classList.add('is-invalid');
                    const err = document.createElement('span');
                    err.className = 'form-error form-error--js';
                    err.textContent = 'Este campo es obligatorio.';
                    field.parentNode.appendChild(err);
                    valid = false;
                }
            });

            const email = form.querySelector('[name="correo"]');
            if (email && email.value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
                email.classList.add('is-invalid');
                const err = document.createElement('span');
                err.className = 'form-error form-error--js';
                err.textContent = 'Ingresa un correo válido.';
                email.parentNode.appendChild(err);
                valid = false;
            }

            if (!valid) {
                e.preventDefault();
                form.querySelector('.is-invalid')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }

            submitBtn.disabled = true;
            submitBtn.querySelector('.submit-text').textContent = 'Enviando...';
        });
    }
});