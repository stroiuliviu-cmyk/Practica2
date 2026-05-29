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

    // 5. Buton back-to-top — apare la scroll > 400 px
    const btnBackToTop = document.querySelector('#btnBackToTop');
    if (btnBackToTop) {
        const toggleVisibility = () => {
            if (window.scrollY > 400) {
                btnBackToTop.classList.add('show');
            } else {
                btnBackToTop.classList.remove('show');
            }
        };
        window.addEventListener('scroll', toggleVisibility, { passive: true });
        btnBackToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // 6. Animații simple la scroll — elemente cu data-reveal apar treptat
    if ('IntersectionObserver' in window) {
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        document.querySelectorAll('[data-reveal]').forEach((el) => revealObserver.observe(el));
    } else {
        // Fallback: arată toate elementele direct dacă browserul nu suportă
        document.querySelectorAll('[data-reveal]').forEach((el) => el.classList.add('is-visible'));
    }

    // 7. Lightbox pentru galerie (folosește modal Bootstrap)
    const lightboxModal = document.querySelector('#lightboxModal');
    if (lightboxModal) {
        const imgEl = lightboxModal.querySelector('#lightboxImage');
        const titleEl = lightboxModal.querySelector('#lightboxLabel');
        const descEl = lightboxModal.querySelector('#lightboxDescription');
        const catEl = lightboxModal.querySelector('#lightboxCategorie');

        lightboxModal.addEventListener('show.bs.modal', (event) => {
            const trigger = event.relatedTarget;
            if (!trigger) return;
            imgEl.src = trigger.dataset.image ?? '';
            imgEl.alt = trigger.dataset.title ?? '';
            titleEl.textContent = trigger.dataset.title ?? 'Vizualizare lucrare';
            descEl.textContent = trigger.dataset.description ?? '';
            const catText = trigger.dataset.categorie ?? '';
            catEl.textContent = catText;
            catEl.style.display = catText ? 'inline-block' : 'none';
        });
    }
});
