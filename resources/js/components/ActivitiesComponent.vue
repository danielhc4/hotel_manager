<template>

	<div class="row h-100">
		<div class="col-12 h-100">
			<div class="card rounded-4 h-100">
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<div>
							<h5 class="card-title">Actividades</h5>
							<!-- <p class="card-text">Actividades</p> -->
						</div>
						<div>
							<button type="button" class="btn hm-button-oak" data-bs-toggle="modal" data-bs-target="#add-modal">
								+ Agregar
							</button>
						</div>
					</div>
					<table class="table hm-table">
						<thead>
							<tr>
								<th scope="col" class="text-left">Actividad</th>
								<th scope="col" class="text-left">Tipo</th>
								<th scope="col" class="text-left">Descripción</th>
								<th scope="col" class="text-left">Departamento</th>
								<th scope="col" class="text-left">Turno</th>
								<th scope="col" class="text-left">Confianza</th>
								<th scope="col" class="text-left">Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="registro in registros" :key="registro.id">
								<td><span class="hm-table-text-dark-bold">{{ registro.name }}</span></td>
								<td>
									<img v-if="registro.activity_type === 'DAILY'" :src="`${ assetUrl }/daily_recurring_task_icon.svg`" title="Diaria" style="width: 25px;">
									<img v-else :src="`${ assetUrl }/sporadic_activity_icon.svg`" title="Extra" style="width: 25px;">
								</td>
								<td>{{ registro.description }}</td>
								<td>
									<span v-if="registro.departments_id !== null" class="badge hm-table-badge hm-table-badge-color-oak">
										{{ registro.department.name }}
									</span>
									<span v-else class="badge hm-table-badge hm-table-badge-color-gold">
										General
									</span>
								</td>
								<td>{{ registro.shift.name }}</td>
								<td v-if="registro.employee">
									Confianza
									<span class="badge hm-table-badge hm-table-badge-color-sort">
										<span v-if="registro.employee.state === 'ACTIVE'" class="hm-dot-badge active"></span>
										<span v-if="registro.employee.state === 'ON_VACATIONS'" class="hm-dot-badge on-vacations"></span>
										<span v-if="registro.employee.state === 'ABSENT'" class="hm-dot-badge absent"></span>
										{{ registro.employee.first_name }} {{ registro.employee.middle_name }} {{ registro.employee.paternal_surename }} {{ registro.employee.maternal_surename }}
									</span>
								</td>
								<td v-else>Normal</td>
								<td class="d-flex">
									<button @click="editar(registro)" type="button" class="hm-icon-btn" data-bs-toggle="modal" data-bs-target="#edit-modal">
										<svg viewBox="0 0 24 24">
											<path d="M12 20h9"></path>
											<path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"></path>
										</svg>
									</button>
									<button @click="eliminar(registro)" type="button" class="hm-icon-btn" data-bs-toggle="modal" data-bs-target="#delete-modal">
										<svg viewBox="0 0 24 24">
											<path d="M3 6h18"></path>
											<path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
											<path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
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

	<!-- Modal Add -->
	<div class="modal " id="add-modal" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form @submit.prevent="save_add">
					<div class="modal-header">
						<h1 class="modal-title fs-5">Agregar actividad</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clear_form()"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-6">
								<div class="mb-3">
									<label for="add_activity_name" class="form-label">Nombre de actividad</label>
									<input type="text" id="add_activity_name" class="form-control hm-input" placeholder="Ej. Limpiar baños" v-model="form_add.name">
								</div>
							</div>
							<div class="col-6">
								<div class="mb-3">
									<label for="add_activity_shift" class="form-label">Turno</label>
									<div class="hm-select-wrap">
										<select class="form-select" id="add_activity_shift" @change="get_employees(form_add.departments_id)" v-model="form_add.shifts_id">
											<option selected :value="null">Selecciona turno</option>
											<option v-for="shift in shifts" :value="shift.id">{{ shift.name }}</option>
										</select>
										<svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"></path></svg>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<div class="mb-3">
									<label for="add_activity_type" class="form-label">Tipo de actividad</label>
									<div class="hm-select-wrap">
										<select class="form-select" id="add_activity_type" v-model="form_add.activity_type">
											<option selected :value="null">Selecciona tipo de actividad</option>
											<option value="DAILY">Diaria</option>
											<option value="EXTRA">Extra</option>
										</select>
										<svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"></path></svg>
									</div>
								</div>
							</div>
							<div class="col-6">
								<div class="mb-3">
									<label for="add_activity_department" class="form-label">Departamento</label>
									<div class="hm-select-wrap">
										<select class="form-select" id="add_activity_department" @change="get_employees(form_add.departments_id)" v-model="form_add.departments_id">
											<option selected :value="null">Actividad general</option>
											<option v-for="department in departments" :value="department.id">{{ department.name }}</option>
										</select>
										<svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"></path></svg>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="mb-3">
									<label for="add_shift_description" class="form-label">Descripción</label>
									<div class="hm-textarea-wrap">
										<textarea id="add_shift_description" class="form-control hm-textarea" placeholder="Ej. Hacer la limpieza completa de baños"  v-model="form_add.description" rows="3"></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<div class="mb-3">
									<label for="add_activity_trust" class="form-label">Actividad de confianza</label>
									<div class="hm-select-wrap">
										<select id="add_activity_trust" class="form-select" v-model="form_add.trusted">
											<option selected :value="null">Actividad de confianza</option>
											<option value="TRUSTED">Sí</option>
											<option value="NO_TRUSTED">No</option>
										</select>
										<svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"></path></svg>
									</div>
								</div>
							</div>
							<div class="col-6" v-if="form_add.trusted === 'TRUSTED'">
								<div class="mb-3">
									<label for="add_activity_trusted_employee" class="form-label">Empleado de confianza</label>
									<div id="add_activity_trusted_employee" class="hm-select-wrap">
										<select class="form-select" id="trusted_employee" v-model="form_add.employees_id">
											<option selected :value="null">Empleado de confianza</option>
											<option v-for="employee in employees" :value="employee.id">{{ employee.first_name }} {{ employee.middle_name }} {{ employee.paternal_surename }} {{ employee.maternal_surename }} ({{ employee.shift.name }}) </option>
										</select>
										<svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"></path></svg>
									</div>
									<div id="trusted_employee_message_error" class="form-text d-none">Si la actividad es de confianza se tiene que elegir un empleado.</div>
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

	<!-- Modal Edit -->
	<div class="modal " id="edit-modal" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form @submit.prevent="save_edit">
					<div class="modal-header">
						<h1 class="modal-title fs-5">Editar actividad</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clear_form()"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-6">
								<div class="mb-3">
									<label class="form-label">Nombre de actividad</label>
									<input type="text" class="form-control hm-input" v-model="form_edit.name">
								</div>
							</div>
							<div class="col-6">
								<div class="mb-3">
									<label class="form-label">Turno</label>
									<div class="hm-select-wrap">
										<select class="form-select" @change="get_employees(form_edit.departments_id)" v-model="form_edit.shifts_id">
											<option selected :value="null">Selecciona turno</option>
											<option v-for="shift in shifts" :value="shift.id">{{ shift.name }}</option>
										</select>
										<svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"></path></svg>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<div class="mb-3">
									<label class="form-label">Tipo de actividad</label>
									<div class="hm-select-wrap">
										<select class="form-select" v-model="form_edit.activity_type">
											<option selected :value="null">Selecciona tipo de actividad</option>
											<option value="DAILY">Diaria</option>
											<option value="EXTRA">Extra</option>
										</select>
										<svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"></path></svg>
									</div>
								</div>
							</div>
							<div class="col-6">
								<div class="mb-3">
									<label for="edit_activity_department" class="form-label">Departamento</label>
									<div class="hm-select-wrap">
										<select class="form-select" id="edit_activity_department" @change="get_employees(form_edit.departments_id)" v-model="form_edit.departments_id">
											<option selected :value="null">Actividad general</option>
											<option v-for="department in departments" :value="department.id">{{ department.name }}</option>
										</select>
										<svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"></path></svg>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="mb-3">
									<label class="form-label">Descripción</label>
									<div class="hm-textarea-wrap">
										<textarea class="form-control hm-textarea"  v-model="form_edit.description" rows="3"></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<div class="mb-3">
									<label class="form-label">Actividad de confianza</label>
									<div class="hm-select-wrap">
										<select class="form-select" v-model="form_edit.trusted">
											<option selected :value="null">Actividad de confianza</option>
											<option value="TRUSTED">Sí</option>
											<option value="NO_TRUSTED">No</option>
										</select>
										<svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"></path></svg>
									</div>
								</div>
							</div>
							<div class="col-6" v-if="form_edit.trusted === 'TRUSTED'">
								<div class="mb-3">
									<label class="form-label">Empleado de confianza</label>
									<div class="hm-select-wrap">
										<select class="form-select" id="trusted_employee" v-model="form_edit.employees_id">
											<option selected :value="null">Empleado de confianza</option>
											<option v-for="employee in employees" :value="employee.id">{{ employee.first_name }} {{ employee.middle_name }} {{ employee.paternal_surename }} {{ employee.maternal_surename }}</option>
										</select>
										<svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"></path></svg>
									</div>
									<div id="trusted_employee_message_error" class="form-text d-none">Si la actividad es de confianza se tiene que elegir un empleado.</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn hm-button-coral" data-bs-dismiss="modal" @click="clear_form()">Cerrar</button>
						<button type="submit" class="btn hm-button-oak">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Modal Delete -->
	<div class="modal " id="delete-modal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<form @submit.prevent="save_delete">
					<div class="modal-header">
						<h1 class="modal-title fs-5">Eliminar actividad</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clear_form()"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<p>¿Seguro que deseas eliminar el actividad <b>{{form_delete.name}}</b>?</p>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="clear_form()">Cerrar</button>
						<button type="submit" class="btn hm-button-coral" data-bs-dismiss="modal">Eliminar</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</template>
<script setup>
import { ref, onMounted, toRaw, reactive } from 'vue';

const props = defineProps({
	assetUrl: {
		type: String,
		require: true
	}
});

const registros = ref([]);
const form_delete = ref({});
const shifts = ref([]);
const employees = ref([]);
const departments = ref([]);
const erroresValidacion = ref({});

const getInitialForm = () => ({
	name: null,
	shifts_id: null,
	activity_type: null,
	description: null,
	employees_id: null,
	departments_id: null,
	created_at: null,
	updated_at: null,
	trusted: null
});

const form_edit = reactive(getInitialForm());
const form_add = reactive(getInitialForm());

const headers = {
	'Accept': 'application/json'
};

onMounted(async () => {
	load_records();
	get_shifts();
	get_departments();
});

async function load_records () {
	const { data } = await axios.get('/api/activities', headers);
	registros.value = data;
};

function clear_form() {
	Object.assign(form_add, getInitialForm());
	Object.assign(form_edit, getInitialForm());
	Object.assign(form_delete, getInitialForm());
};

const get_shifts = async () => {
	const response = await axios.get('/api/shifts', headers);
	shifts.value = response.data;
};

const get_employees = async (departament_id) => {
	if(departament_id !== null || departament_id !== undefined) {
		const response = await axios.get(`/api/employees?campo=departments_id&q=${departament_id}`, headers);
		var employee_filtered = [];
		if(form_add.shifts_id == null && form_edit.shifts_id == null) {
			employees.value = response.data;
		}
		else {
			for(var i = 0; i < response.data.length; i++) {
				if(form_add.shifts_id !== null) {
					if(response.data[i].shifts_id == form_add.shifts_id) {
						employee_filtered.push(response.data[i]);
					}
				}
				if(form_edit.shifts_id !== null) {
					if(response.data[i].shifts_id == form_edit.shifts_id) {
						employee_filtered.push(response.data[i]);
					}
				}
			}
			employees.value = employee_filtered;
		}
	}
};

const get_departments = async () => {
	const response = await axios.get('/api/departments', headers);
	departments.value = response.data;
};

function editar(registro) {
	Object.assign(form_edit, registro);
	form_edit.trusted = registro.employees_id == null ? 'NO_TRUSTED' : 'TRUSTED';
};

function eliminar(registro) {
	form_delete.value = structuredClone(toRaw(registro));
};

const save_add = async () => {
	try {
		await axios.post(`/api/activities`, form_add, headers);
		load_records();
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
	Object.assign(form_add, getInitialForm());
};

const save_edit = async () => {
	$('#trusted_employee').removeClass('hm-grid-form-select-error');
	$('#trusted_employee_message_error').addClass('d-none');
	if(form_edit.trusted === 'NO_TRUSTED' || (form_edit.trusted === 'TRUSTED' && form_edit.employees_id !== null)) {
		try {
			if(form_edit.trusted === 'NO_TRUSTED') {
				form_edit.employees_id = null;
			}
			await axios.put(`/api/activities`, form_edit, headers);
			bootstrap.Modal.getInstance($('#edit-modal')[0]).hide();
			load_records();
		}
		catch(error) {
			bootstrap.Modal.getInstance($('#edit-modal')[0]).hide();
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

					$('#modal-error-title').html('Error al guardar cambios en actividad');
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
					console.error('Error interno del servidor');
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
	else {
		$('#trusted_employee').addClass('hm-grid-form-select-error');
		$('#trusted_employee_message_error').removeClass('d-none');
		
	}
	Object.assign(form_edit, getInitialForm());
};

const save_delete = async () => {
	try {
		await axios.delete(`/api/activities/${form_delete.value.id}`, headers);
		load_records();
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

				$('#modal-error-title').html('Error al guardar cambios en departamento');
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
	Object.assign(form_delete, getInitialForm());
};
</script>