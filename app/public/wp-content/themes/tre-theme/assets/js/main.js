/**
 * TRE Radio — main.js
 * JS léger, sans dépendances
 */
(function () {
    'use strict';

    /* ── Dropdown accessibilité clavier ── */
    document.querySelectorAll('.tre-nav-inner .menu-item-has-children').forEach(function (item) {
        var link = item.querySelector(':scope > a');

        // Survol déjà géré en CSS; ici on gère le focus clavier
        link.addEventListener('focus', function () {
            item.classList.add('focus');
        });
        item.addEventListener('focusout', function (e) {
            if (!item.contains(e.relatedTarget)) {
                item.classList.remove('focus');
            }
        });

        // Clic sur mobile (pas de hover)
        link.addEventListener('click', function (e) {
            if (window.innerWidth < 769) {
                e.preventDefault();
                var isOpen = item.classList.toggle('open');
                var sub = item.querySelector('.sub-menu');
                if (sub) {
                    sub.style.opacity     = isOpen ? '1' : '0';
                    sub.style.visibility  = isOpen ? 'visible' : 'hidden';
                    sub.style.pointerEvents = isOpen ? 'all' : 'none';
                    sub.style.transform   = isOpen ? 'translateY(0)' : 'translateY(8px)';
                }
            }
        });
    });

    /* ── Fermer les dropdowns au clic dehors (mobile) ── */
    document.addEventListener('click', function (e) {
        if (window.innerWidth < 769 && !e.target.closest('.tre-nav-inner')) {
            document.querySelectorAll('.menu-item-has-children.open').forEach(function (item) {
                item.classList.remove('open');
                var sub = item.querySelector('.sub-menu');
                if (sub) {
                    sub.style.opacity      = '0';
                    sub.style.visibility   = 'hidden';
                    sub.style.pointerEvents = 'none';
                }
            });
        }
    });

    /* ── Animation au scroll (Intersection Observer) ── */
    if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.style.opacity   = '1';
                    entry.target.style.transform = 'translateY(0)';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.article-card, .article-horiz, .tre-hero').forEach(function (el) {
            el.style.opacity    = '0';
            el.style.transform  = 'translateY(20px)';
            el.style.transition = 'opacity .5s ease, transform .5s ease';
            observer.observe(el);
        });
    }

    /* ── Sticky nav : ajoute classe scrolled ── */
    var nav = document.querySelector('.tre-nav-wrapper');
    if (nav) {
        window.addEventListener('scroll', function () {
            nav.classList.toggle('scrolled', window.scrollY > 60);
        }, { passive: true });
    }

})();
