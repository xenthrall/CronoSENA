import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import listPlugin from '@fullcalendar/list';

import esLocale from '@fullcalendar/core/locales/es';

document.addEventListener('DOMContentLoaded', function () {

    const calendarEl = document.getElementById('calendar');
    if (!calendarEl) return;

    const tipo = calendarEl.dataset.tipo;
    const id = calendarEl.dataset.id;

    const calendar = new Calendar(calendarEl, {
        plugins: [
            dayGridPlugin,
            timeGridPlugin,
            interactionPlugin,
            listPlugin
        ],

        initialView: 'dayGridMonth',

        locale: esLocale,
        timeZone: 'America/Bogota',

        // Formato AM / PM
        slotLabelFormat: {
            hour: 'numeric',
            minute: '2-digit',
            hour12: true
        },

        eventTimeFormat: {
            hour: 'numeric',
            minute: '2-digit',
            hour12: true
        },

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },

        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día',
            list: 'Lista'
        },

        events: `/api/events/${tipo}/${id}`,
    });

    calendar.render();
});
