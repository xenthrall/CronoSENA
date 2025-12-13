import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
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
            interactionPlugin,
            listPlugin
        ],

        initialView: 'dayGridMonth',

        locale: esLocale,
        timeZone: 'America/Bogota',

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,listMonth'
        },

        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            list: 'Lista'
        },

        eventContent: function (arg) {
            const shift = arg.event.extendedProps.shift;

            return {
                html: `
                    <div>
                        <div class="font-semibold">${arg.event.title}</div>
                        <div class="text-xs opacity-70">${shift}</div>
                    </div>
                `
            };
        },

        events: `/api/events/${tipo}/${id}`,
    });

    calendar.render();
});
