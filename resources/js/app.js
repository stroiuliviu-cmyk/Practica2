// FotoMoments — script principal (Bootstrap 5 + interactivitate vanilla)
import * as bootstrap from 'bootstrap';

// 1. Inițializare tooltipuri Bootstrap
document.addEventListener('DOMContentLoaded', () => {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    [...tooltipTriggerList].forEach((el) => new bootstrap.Tooltip(el));

    // 2. Smooth scroll pentru ancorele interne
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener('click', (event) => {
            const targetId = anchor.getAttribute('href');
            if (targetId.length > 1) {
                const targetEl = document.querySelector(targetId);
                if (targetEl) {
                    event.preventDefault();
                    targetEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        });
    });

    // 3. Validare client-side a formularului de contact (extra peste validarea server)
    const formContact = document.querySelector('#form-contact');
    if (formContact) {
        formContact.addEventListener('submit', (event) => {
            const nume = formContact.querySelector('[name="nume"]')?.value.trim() ?? '';
            const email = formContact.querySelector('[name="email"]')?.value.trim() ?? '';
            const subiect = formContact.querySelector('[name="subiect"]')?.value.trim() ?? '';
            const mesaj = formContact.querySelector('[name="mesaj"]')?.value.trim() ?? '';

            const erori = [];
            if (nume.length < 2) erori.push('Numele trebuie să aibă cel puțin 2 caractere.');
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) erori.push('Adresa de email nu este validă.');
            if (subiect.length < 3) erori.push('Subiectul trebuie să aibă cel puțin 3 caractere.');
            if (mesaj.length < 10) erori.push('Mesajul trebuie să aibă cel puțin 10 caractere.');

            if (erori.length > 0) {
                event.preventDefault();
                alert('Vă rugăm să completați corect formularul:\n\n• ' + erori.join('\n• '));
            }
            // Notă: în caz contrar formularul este trimis la server pentru validarea Laravel.
        });
    }

    // 4. Highlight pentru link-ul activ din navbar
    const path = window.location.pathname;
    document.querySelectorAll('.navbar-nav .nav-link').forEach((link) => {
        const href = link.getAttribute('href');
        if (href && href !== '/' && path.startsWith(href)) {
            link.classList.add('active');
        } else if (href === '/' && path === '/') {
            link.classList.add('active');
        }
    });
});
