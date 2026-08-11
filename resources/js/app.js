import './bootstrap';

import Alpine from 'alpinejs';

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-icons/font/bootstrap-icons.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

window.Alpine = Alpine;

Alpine.start();

// =====================================================
// DARK MODE
// =====================================================

document.addEventListener('DOMContentLoaded', () => {

    const html = document.documentElement;
    const button = document.getElementById('themeToggle');

    if (!body || !button) return;

    // Ambil tema yang tersimpan
    let theme = localStorage.getItem('theme');

    if (!theme) {
        theme = 'light';
    }

    html.setAttribute('data-bs-theme',theme);

    updateIcon(theme);

    button.addEventListener('click', () => {

        theme = html.getAttribute('data-bs-theme');

        if (theme === 'light') {
            theme = 'dark';
        } else {
            theme = 'light';
        }

        html.setAttribute('data-bs-theme', theme);

        localStorage.setItem('theme', theme);

        updateIcon(theme);

    });

    function updateIcon(theme){

        if(theme === 'dark'){

            button.innerHTML =
                '<i class="bi bi-sun-fill"></i>';

        }else{

            button.innerHTML =
                '<i class="bi bi-moon-fill"></i>';

        }

    }

});

// ====================================
// SIDEBAR COLLAPSE
// ====================================

document.addEventListener('DOMContentLoaded',()=>{

    const sidebar =
        document.getElementById('sidebar');

    const content =
        document.querySelector('.main-content');

    const button =
        document.getElementById('sidebarToggle');

    if(!sidebar || !button || !content) return;

    const saved =
        localStorage.getItem('sidebar');

    if(saved === 'collapsed'){

        sidebar.classList.add('collapsed');

        content.classList.add('expanded');

    }

    button.addEventListener('click',()=>{

        sidebar.classList.toggle('collapsed');

        content.classList.toggle('expanded');

        if(sidebar.classList.contains('collapsed')){

            localStorage.setItem(
                'sidebar',
                'collapsed'
            );

        }else{

            localStorage.setItem(
                'sidebar',
                'expanded'
            );

        }

    });

    // Remove preload class after a tiny delay so transitions work on toggle
    requestAnimationFrame(() => {
        requestAnimationFrame(() => {
            document.documentElement.classList.remove('preload-collapsed');
        });
    });

});

// ==========================================
// BOOTSTRAP TOOLTIP
// ==========================================

const tooltipTriggerList =
    [].slice.call(
        document.querySelectorAll(
            '[data-bs-toggle="tooltip"]'
        )
    );

tooltipTriggerList.map(function (el) {

    return new bootstrap.Tooltip(el);

});

// ==========================================
// PAGE TRANSITION & LOADER
// ====================================

document.addEventListener('DOMContentLoaded', () => {
    const pageLoader = document.getElementById('pageLoader');
    const mainContent = document.querySelector('main');

    if (mainContent) {
        mainContent.classList.add('page-transition-enter');
    }

    // 2. Handle internal link clicks
    document.addEventListener('click', (e) => {
        const link = e.target.closest('a');
        if (!link) return;

        const href = link.getAttribute('href');
        
        // Ignore if no href, anchor link, javascript, mailto, tel, or opens in new tab
        if (!href || 
            href.startsWith('#') || 
            href.startsWith('javascript:') ||
            href.startsWith('mailto:') ||
            href.startsWith('tel:') ||
            link.target === '_blank' ||
            e.ctrlKey || e.shiftKey || e.metaKey || e.altKey ||
            e.button !== 0 // Not left click
        ) {
            return;
        }

        try {
            const url = new URL(href, window.location.origin);
            if (url.origin !== window.location.origin) return; // external link
            
            // Ignore common file extensions
            const ext = url.pathname.split('.').pop().toLowerCase();
            if (['pdf', 'zip', 'xls', 'xlsx', 'csv'].includes(ext)) return;
            
            // Ignore route with export or download
            if(href.includes('export') || href.includes('download')) return;
        } catch (err) {
            return;
        }

        // Valid internal navigation
        e.preventDefault();
        
        if (pageLoader) {
            pageLoader.classList.remove('fade-out');
            
            // Navigate almost immediately, just enough for CSS to paint
            setTimeout(() => {
                window.location.href = href;
            }, 30);
        } else {
            window.location.href = href;
        }
    });
});

// Handle Back/Forward buttons (BFCache)
window.addEventListener('pageshow', (e) => {
    const pageLoader = document.getElementById('pageLoader');
    if (pageLoader && e.persisted) { 
        pageLoader.classList.add('fade-out');
    }
});