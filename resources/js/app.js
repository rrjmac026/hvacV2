import './bootstrap';
import Alpine from 'alpinejs';

// FullCalendar imports
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            selectable: true,
            editable: true,
            events: window.appointments || [] // This will be populated from your blade view
        });
        calendar.render();
    }
});

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
