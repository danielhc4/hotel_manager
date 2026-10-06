import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function () {
	const calendarEl = document.getElementById('calendar');
	if (calendarEl) {
		const calendar = new Calendar(calendarEl, {
			/*
			plugins: [dayGridPlugin, interactionPlugin],
			initialView: 'dayGridMonth',
			locale: 'en',
			events: '/api/eventos',
			*/
			plugins: [dayGridPlugin, interactionPlugin],
			initialView: 'dayGridMonth',
			locale: 'es',
			firstDay: 1,
			buttonText: {
				today: 'Hoy',
				month: 'Mes',
				week: 'Semana',
				day: 'Día'
			},
			events: '/api/eventos',

			dateClick: function (info) {
				modalFecha.textContent = info.dateStr;
				modal.dataset.fecha = info.dateStr;
				modal.classList.add('is-open');
			}
		});
		calendar.render();
	}
});