import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import listPlugin from "@fullcalendar/list";

import esLocale from "@fullcalendar/core/locales/es";

document.addEventListener("DOMContentLoaded", function () {
    const calendarEl = document.getElementById("calendar-programacion");
    if (!calendarEl) return;

    const tipo = calendarEl.dataset.tipo;
    const id = calendarEl.dataset.id;

    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin, listPlugin],

        initialView: "dayGridMonth",

        locale: esLocale,
        timeZone: "America/Bogota",

        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,listMonth",
        },

        buttonText: {
            today: "Hoy",
            month: "Mes",
            list: "Lista",
        },
        


        eventContent: function (arg) {
            const {
                shift,
                executed_hours,
                execution_range,
                location,
                environment,
            } = arg.event.extendedProps;

            const view = arg.view.type;

            /* ===============================
            * VISTA MENSUAL (GRID)
            * =============================== */
            if (view === "dayGridMonth") {
                return {
                    html: `
                        <div class="fc-event-custom fc-event-grid">
                            <div class="fc-event-title-main">
                                ${arg.event.title}
                            </div>

                            <div class="fc-event-footer">
                                <span class="fc-event-shift">${shift}</span>
                                ${
                                    executed_hours
                                        ? `<span class="fc-event-hours">${executed_hours} h</span>`
                                        : ""
                                }
                            </div>
                        </div>
                    `,
                };
            }

            /* ===============================
            * VISTA LISTA (LIST MONTH)
            * =============================== */
            if (view === "listMonth") {
                return {
                    html: `
                        <div class="fc-event-custom fc-event-list">
                            <div class="fc-event-title-main">
                                ${arg.event.title}
                            </div>

                            ${
                                execution_range
                                    ? `<div class="fc-event-range">${execution_range}</div>`
                                    : ""
                            }

                            ${
                                location && environment
                                    ? `<div class="fc-event-meta">Ubicación: ${location} · ${environment}</div>`
                                    : ""
                            }

                            <div class="fc-event-footer">
                                <span class="fc-event-shift">${shift}</span>
                            </div>
                        </div>
                    `,
                };
            }

            return true;
        },


        events: `/api/events/${tipo}/${id}`,
    });

    calendar.render();
    

    window.addEventListener("calendar-refresh", () => {
        calendar.refetchEvents();
    });
});
