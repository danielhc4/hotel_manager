<template>
    
    <div class="row">
		<div class="col-12 h-100">

			<div v-for="registro in registros" class="card rounded-4 mb-5">
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<h5 class="card-title">{{registro.department}}</h5>
						<!-- <p class="card-text">Actividades</p> -->
					</div>
					<div>
						<table v-for="shift in registro.shifts" class="table hm-table mb-5">
							<thead>
								<tr>
									<th colspan="5">{{ shift.name }}
										<span v-if="turnos_activos.indexOf(shift.id) >= 0" class="badge hm-table-badge hm-table-badge-color-oak">Activo</span>
										<span v-if="turnos_expirados.indexOf(shift.id) >= 0" class="badge hm-table-badge hm-table-badge-color-coral">Vencido</span>
									</th>
								</tr>
								<tr>
									<th scope="col" class="text-left">Actividad</th>
									<th scope="col" class="text-left">Tipo</th>
									<th scope="col" class="text-left">Descripción</th>
									<th scope="col" class="text-left">Confianza</th>
									<th scope="col" class="text-left">Registrar</th>
								</tr>
							</thead>
							<tbody>
								<tr :class="{ 'hm-table-row-disable-bg': activity_has_notes(activity.id) }" v-for="activity in shift.activities">
									<td>{{activity.name}}</td>
									<td>
										<img v-if="activity.activity_type === 'DAILY'" :src="`${ assetUrl }/daily_recurring_task_icon.svg`" title="Diaria" style="width: 25px;">
										<img v-else :src="`${ assetUrl }/sporadic_activity_icon.svg`" title="Extra" style="width: 25px;">
									</td>
									<td>{{activity.description}}</td>
									<td>
										<span v-if="activity.employees_id == null" class="badge hm-table-badge hm-table-badge-color-gold">Actividad General</span>
										<span v-else class="badge hm-table-badge hm-table-badge-color-oak">{{activity.employee.first_name}} {{activity.employee.middle_name}} {{activity.employee.paternal_surename}} {{activity.employee.maternal_surename}}</span>
									</td>
									<td class="d-flex">
										<button @click="do_activity(activity)" type="button" :disabled="activity_has_notes(activity.id)" class="hm-icon-btn" data-bs-toggle="modal" data-bs-target="#do-activity-modal">
											<svg viewBox="0 0 24 24">
												<path d="M20 6L9 17l-5-5"></path>
											</svg>
										</button>
										<button @click="view_notes(activity)" type="button" :disabled="!activity_has_notes(activity.id)" class="hm-icon-btn" data-bs-toggle="modal" data-bs-target="#notes-modal">
											<svg viewBox="0 0 24 24">
												<path d="M12 20h9"></path>
												<path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"></path>
											</svg>
										</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>

				</div>
			</div>

		</div>
	</div>

	<!-- Modal do activity -->
	<div class="modal " id="do-activity-modal" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form @submit.prevent="save_activity_do">
					<div class="modal-header">
						<h1 class="modal-title fs-5">Realizar actividad</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clear_form()"></button>
					</div>
					<div class="modal-body">
						<div class="d-flex">
							<div class="w-75 me-3 mb-3">
								<input type="text" class="form-control hm-input" v-model="actividad.name" disabled>
							</div>
							<div class="w-25 mb-3">
								<input v-if="actividad.employees_id == null" type="text" class="form-control hm-input" value="Confianza: No" disabled>
								<input v-else type="text" class="form-control hm-input" value="Confianza: Sí" disabled>
							</div>
						</div>
						<div class="mb-3 hm-textarea-wrap">
							<textarea :value="actividad.description" class="form-control hm-textarea" rows="3" style="resize: none;" disabled></textarea>
						</div>
						<div class="mb-3 hm-textarea-wrap">
							<textarea v-model="form_add.notes" rows="3" class="form-control hm-textarea" placeholder="Notas"></textarea>
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

	<!-- Modal do activity -->
	<div class="modal " id="notes-modal" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form @submit.prevent="save_activity_do">
					<div class="modal-header">
						<h1 class="modal-title fs-5">Ver notas</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clear_form()"></button>
					</div>
					<div class="modal-body">
						 <div class="d-flex">
							<div class="w-75 me-3 mb-3">
								<input type="text" class="form-control hm-input" v-model="actividad.name" disabled>
							</div>
							<div class="w-25 mb-3">
								<input v-if="actividad.employees_id == null" type="text" class="form-control hm-input" value="Confianza: No" disabled>
								<input v-else type="text" class="form-control hm-input" value="Confianza: Sí" disabled>
							</div>
						</div>
						<div class="mb-3 hm-textarea-wrap">
							<textarea :value="notas_actividad" class="form-control hm-textarea" rows="3" style="resize: none;" disabled></textarea>
						</div>
						<div class="mb-3 hm-textarea-wrap">
							<textarea v-model="form_add.notes" rows="3" class="form-control hm-textarea" placeholder="Notas"></textarea>
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

const props = defineProps({
	assetUrl: {
		type: String,
		require: true
	}
});

const registros = ref([]);
const actividad = ref({});
const notas = ref([]);
const notas_actividad = ref('');
const turnos_activos = ref([]);
const turnos_expirados = ref([]);
const erroresValidacion = ref({});

let intervalo = null;

const getInitialForm = () => ({
	activities_id: null,
	notes: null,
});

const form_add = reactive(getInitialForm());

const headers = {
	'Accept': 'application/json'
};

onMounted(async () => {
	load_records();
	load_notes();
	update_shifts();
	var intervalo = setInterval(update_shifts, 60000);
});

async function load_records () {
	const { data } = await axios.get('/api/activities_grouped', headers);
	registros.value = data;
};

async function load_notes () {
	const { data } = await axios.get('/api/checkList_today_notes');
	notas.value = data;
};

async function update_shifts() {
	const { data } = await axios.get('/api/shift_active');
	let ids = [];
	for(var i = 0; i < data.length; i++) {
		ids.push(data[i].id);
	}
	turnos_activos.value = ids;


	var datas = await axios.get('/api/shift_expired');
	ids = [];
	for(var i = 0; i < datas.data.length; i++) {
		ids.push(datas.data[i].id);
	}
	turnos_expirados.value = ids;
}

function activity_has_notes(id) {
	for(var i = 0; i < notas.value.length; i++) {
		if(notas.value[i].activities_id == id) {
			return true;
		}
	}
	return false;
}

function clear_form() {
	Object.assign(form_add, getInitialForm());
};

function do_activity(activity) {
	actividad.value = activity;
	form_add.activities_id = activity.id;
};

function view_notes(activity) {
	actividad.value = activity;
	form_add.activities_id = activity.id;
	var formato_nota = '';
	for(var i = 0; i < notas.value.length; i++) {
		if(notas.value[i].activities_id == activity.id) {
			let cdate = new Date(notas.value[i].created_at);
			formato_nota += cdate.toLocaleString('es-MX') + '\n' + notas.value[i].notes + '\n--------------------\n';
		}
	}
	notas_actividad.value = formato_nota;
};

const save_activity_do = async () => {
	try {
		await axios.post(`/api/checkList`, form_add, headers);
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
	load_records();
	load_notes ();
	Object.assign(form_add, getInitialForm());
}
</script>