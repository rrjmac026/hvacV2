import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Improved dark mode functionality
window.toggleDarkMode = function() {
    const root = document.documentElement;
    root.classList.add('transitioning');
    
    if (root.classList.contains('dark')) {
        root.classList.remove('dark');
        localStorage.theme = 'light';
    } else {
        root.classList.add('dark');
        localStorage.theme = 'dark';
    }

    // Remove transition class after animation completes
    setTimeout(() => {
        root.classList.remove('transitioning');
    }, 250);
}

// Initial theme setup
if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
} else {
    document.documentElement.classList.remove('dark');
}

// Initialize Alpine.js store
document.addEventListener('alpine:init', () => {
    Alpine.store('sidebar', {
        open: true,
        toggle() {
            this.open = !this.open;
        }
    });
});

Alpine.start();
