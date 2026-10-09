<template>

    <div class="row h-100">
        <div class="col-12">
            <div class="card rounded-4 h-100">
                <div class="card-body">
                    <h5 class="card-title">Asistencia</h5>
                    <p class="card-text">Asistencia de empleados</p>
                    <div id="calendar"></div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal Add -->
	<div class="modal " id="edit-attendance" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form @submit.prevent="save_add">
					<div class="modal-header">
						<h1 class="modal-title fs-5">Editar departamento</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clear_form()"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<div class="hm-select-wrap">
								<select @change="view_employees()" class="form-select" v-model="form_add.employees_id">
									<option :value="null">Seleccione empleado</option>
									<option :value="employee.id" v-for="employee in employees">{{employee.first_name}} {{employee.middle_name}} {{employee.paternal_surename}} {{employee.maternal_surename}}</option>
								</select>
								<svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"></path></svg>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-6">
								<label for="add_employee_first_name" class="form-label">Nombre</label>
								<input type="text" class="hm-input" disabled v-model="employee.first_name">
							</div>
							<div class="col-6">
								<label for="add_employee_first_name" class="form-label">Segundo Nombre</label>
								<input type="text" class="hm-input" disabled v-model="employee.middle_name">
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-6">
								<label for="add_employee_first_name" class="form-label">Primer Apellido</label>
								<input type="text" class="hm-input" disabled v-model="employee.paternal_surename">
							</div>
							<div class="col-6">
								<label for="add_employee_first_name" class="form-label">Segundo Apellido</label>
								<input type="text" class="hm-input" disabled v-model="employee.maternal_surename">
							</div>
						</div>
						<div class="row">
							<div class="col-1" v-if="employee.state != null">
								<label for="add_employee_first_name" class="form-label">Estado</label>
								<span v-if="employee.state == 'ACTIVE'" class="badge rounded-pill text-bg-light border p-1 px-3 text-secondary" style="font-size: 0.80rem; font-weight: 400;"> <span class="hm-dot-badge active"></span> Activo</span>
								<span v-else-if="employee.state == 'ON_VACATIONS'" class="badge rounded-pill text-bg-light border p-1 px-3 text-secondary" style="font-size: 0.80rem; font-weight: 400;"> <span class="hm-dot-badge on-vacations"></span> Vacaciones</span>
								<span v-else class="badge rounded-pill text-bg-light border p-1 px-3 text-secondary" style="font-size: 0.80rem; font-weight: 400;"> <span class="hm-dot-badge absent"></span> Ausente</span>
							</div>
						</div>
						<div class="row" v-if="employee.id > 0">
							<div class="col-6">
								<label class="form-label">Entrada</label>
								<div class="hm-select-wrap">
									<select class="form-select" v-model="form_add.entry" :disabled="employee.state !== 'ACTIVE'">
										<option value="00:00:00">00:00</option>
										<option value="01:00:00">01:00</option>
										<option value="02:00:00">02:00</option>
										<option value="03:00:00">03:00</option>
										<option value="04:00:00">04:00</option>
										<option value="05:00:00">05:00</option>
										<option value="06:00:00">06:00</option>
										<option value="07:00:00">07:00</option>
										<option value="08:00:00">08:00</option>
										<option value="09:00:00">09:00</option>
										<option value="10:00:00">10:00</option>
										<option value="11:00:00">11:00</option>
										<option value="12:00:00">12:00</option>
										<option value="13:00:00">13:00</option>
										<option value="14:00:00">14:00</option>
										<option value="15:00:00">15:00</option>
										<option value="16:00:00">16:00</option>
										<option value="17:00:00">17:00</option>
										<option value="18:00:00">18:00</option>
										<option value="19:00:00">19:00</option>
										<option value="20:00:00">20:00</option>
										<option value="21:00:00">21:00</option>
										<option value="22:00:00">22:00</option>
										<option value="23:00:00">23:00</option>
									</select>
									<svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"></path></svg>
								</div>
							</div>
							<div class="col-6">
								<label  class="form-label">Salida</label>
								<div class="hm-select-wrap">
									<select class="form-select" v-model="form_add.ending" :disabled="employee.state !== 'ACTIVE'">
										<option value="00:00:00">00:00</option>
										<option value="01:00:00">01:00</option>
										<option value="02:00:00">02:00</option>
										<option value="03:00:00">03:00</option>
										<option value="04:00:00">04:00</option>
										<option value="05:00:00">05:00</option>
										<option value="06:00:00">06:00</option>
										<option value="07:00:00">07:00</option>
										<option value="08:00:00">08:00</option>
										<option value="09:00:00">09:00</option>
										<option value="10:00:00">10:00</option>
										<option value="11:00:00">11:00</option>
										<option value="12:00:00">12:00</option>
										<option value="13:00:00">13:00</option>
										<option value="14:00:00">14:00</option>
										<option value="15:00:00">15:00</option>
										<option value="16:00:00">16:00</option>
										<option value="17:00:00">17:00</option>
										<option value="18:00:00">18:00</option>
										<option value="19:00:00">19:00</option>
										<option value="20:00:00">20:00</option>
										<option value="21:00:00">21:00</option>
										<option value="22:00:00">22:00</option>
										<option value="23:00:00">23:00</option>
									</select>
									<svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"></path></svg>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn hm-button-coral" data-bs-dismiss="modal" @click="clear_form()">Cerrar</button>
						<button type="submit" class="btn hm-button-oak" data-bs-dismiss="modal">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</template>
<script setup>
import { ref, onMounted, reactive } from 'vue';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import esLocale from '@fullcalendar/core/locales/es';
import { Modal } from 'bootstrap';

document.addEventListener('DOMContentLoaded', () => {
	const calendarEl = document.getElementById('calendar');
	const calendar = new Calendar(calendarEl, {
		plugins: [dayGridPlugin, interactionPlugin],
		locale: esLocale,
		initialView: 'dayGridMonth',
		firstDay: 1,
		height: 'auto',
		headerToolbar: {
			left: 'prev,next today',
			center: 'title',
			right: 'dayGridMonth,timeGridWeek',
		},

		dateClick(info) {
			today.value = info;
            const modal = new Modal($('#edit-attendance')[0]);
            modal.show();
		},

	});
	calendar.render();

});

const employees = ref([]);
const employee = ref({});
const today = ref('');
const erroresValidacion = ref({});
const employee_id_buffer = ref(0);

const headers = {
	'Accept': 'application/json'
};

const getInitialForm = () => ({
	id: null,
	employees_id: null,
	entry: null,
	ending: null,
});

const form_add = reactive(getInitialForm());

onMounted(async () => {
	load_records();
});

async function load_records () {
	const { data } = await axios.get('/api/employees', headers);
	employees.value = data;
};

function clear_form() {
	Object.assign(form_add, getInitialForm());
};

const view_employees = async () => {
	var employee_id = 0;
	for(var i = 0; i < employees.value.length; i++) {
		if(employees.value[i].id == form_add.employees_id) {
			employee_id = employees.value[i].id;
			break;
		}
	}
	employee_id_buffer.value = employee_id;
	Object.assign(form_add, getInitialForm());
	view_employee_attendance(employee_id);
	const { data } = await axios.get(`/api/employees/${employee_id}`, headers);
	employee.value = data;
}

const view_employee_attendance = async (employee_id) => {
	var year = today.value.date.getFullYear();
	var month = today.value.date.getMonth() + 1;
	var day = p(today.value.date.getDate());
	var new_form_data = {
		employees_id: employee_id,
		date: year + '-' + month + '-' + day + ' ',
	};
	const { data } = await axios.post(`/api/getAttendanceEmployee`, new_form_data, headers);
	if(data.length > 0) {
		let buffer = {
			id: data[0].id,
			employees_id: data[0].employees_id,
			entry: data[0].entry.slice(-8),
			ending: data[0].ending.slice(-8)
		};
		Object.assign(form_add, buffer);
	}
};

const p = (n) => String(n).padStart(2, '0');

const save_add = async () => {

	if(form_add.entry !== null && form_add.ending !== null) {
		var year = today.value.date.getFullYear();
		var month = today.value.date.getMonth() + 1;
		var day = p(today.value.date.getDate());

		var new_form_data = {
			id: form_add.id,
			employees_id: employee_id_buffer.value,
			entry: year + '-' + month + '-' + day + ' ' + form_add.entry,
			ending: year + '-' + month + '-' + day + ' ' + form_add.ending
		};

		try {

			if(form_add.id == null) {
				await axios.post(`/api/attendance`, new_form_data, headers);
			}
			else {
				await axios.put(`/api/attendance`, new_form_data, headers);
			}
		}
		catch(error) {
			if (error.response) {
				const status = error.response.status
				if (status === 422) {
					erroresValidacion.value = error.response.data.errors;
					// console.log(error.response.data);
					// console.log(error.response.status);
					// console.log(error.response.statusText);
					// console.log(error.response.headers);
					let options = {
						backdrop: true,
						focus: true,
						keyboard: true
					};

					let error_description = '';

					error_description += '<b class="mh-text-dark">Tipo:</b> HTTP<br>';
					error_description += '<b class="mh-text-dark">Código:</b> ' + error.response.status + ' ' + error.response.statusText + '<br>';
					error_description += '<b class="mh-text-dark">Descripción:</b> ' + error.response.data.message + '<br>';

					$('#modal-error-title').html('Error al guardar nuevo departamento');
					$('#modal-error-description').html('Al guardar el registro se presentó un problema. Intente nuevamente y en caso de persistir reporte el problema.');
					$('#modal-error-code').html(error_description);
					const errorModal = new bootstrap.Modal('#modal-error', options);
					errorModal.show();
				}
				else if (status === 404) {
					console.error('El registro no existe')
				}
				else if (status === 401 || status === 403) {
					console.error('No tienes permiso para esta acción')
				}
				else if (status === 500) {
					console.error('Error interno del servidor')
				}
			}
			else if (error.request) {
				console.error('No hubo respuesta del servidor')
			}
			else {
				console.error('Error inesperado:', error.message)
			}
		}
	}

	
	Object.assign(form_add, getInitialForm());

};

</script>