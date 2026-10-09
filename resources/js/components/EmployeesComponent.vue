<template>

	<div class="row h-100">
		<div class="col-12 h-100">
			<div class="card rounded-4 h-100">
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<div>
							<h5 class="card-title">Empleados</h5>
							<!-- <p class="card-text">Empleados</p> -->
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
								<th scope="col" class="text-left">Nombre</th>
								<th scope="col" class="text-left">Departamento</th>
								<th scope="col" class="text-left">Turno</th>
								<th scope="col" class="text-left">Teléfono</th>
								<th scope="col" class="text-left">Dirección</th>
								<th scope="col" class="text-left">Estado</th>
								<th scope="col" class="text-left">Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="registro in registros" :key="registro.id">
								<td>
									<div class="hm-table-cell">
										<div class="hm-avatar">
											{{ registro.first_name.charAt(0) + registro.paternal_surename.charAt(0) }}
										</div>
										<div class="hm-info">
											{{ registro.first_name }} {{ registro.middle_name }} {{ registro.paternal_surename }} {{ registro.maternal_surename }}
										</div>
									</div>
								</td>
								<td><span class="badge rounded-pill border hm-table-badge hm-table-badge-color-sort">{{ registro.department.name }}</span></td>
								<td><span class="hm-table-text-mutted">{{ registro.shift.name }}</span></td>
								<td>{{ registro.phone }}</td>
								<td>{{ registro.address }}</td>
								<td>
									<span v-if="registro.state == 'ACTIVE'" class="badge rounded-pill text-bg-light border p-1 px-3 text-secondary" style="font-size: 0.80rem; font-weight: 400;"> <span class="hm-dot-badge active"></span> Activo</span>
									<span v-else-if="registro.state == 'ON_VACATIONS'" class="badge rounded-pill text-bg-light border p-1 px-3 text-secondary" style="font-size: 0.80rem; font-weight: 400;"> <span class="hm-dot-badge on-vacations"></span> Vacaciones</span>
									<span v-else class="badge rounded-pill text-bg-light border p-1 px-3 text-secondary" style="font-size: 0.80rem; font-weight: 400;"> <span class="hm-dot-badge absent"></span> Ausente</span>
								</td>
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
						<h1 class="modal-title fs-5">Agregar empleado</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clear_form()"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-6">
								<div class="mb-3">
									<label for="add_employee_first_name" class="form-label">Nombre</label>
									<input type="text" id="add_employee_first_name" class="form-control hm-input" placeholder="Ej. Juan" v-model="form_add.first_name">
								</div>
							</div>
							<div class="col-6">
								<div class="mb-3">
									<label for="add_employee_middle_name" class="form-label">Segundo nombre</label>
									<input type="text" id="add_employee_middle_name" class="form-control hm-input" placeholder="Ej. Pedro" v-model="form_add.middle_name">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<div class="mb-3">
									<label for="add_employee_paternal_surename" class="form-label">Primer apellido</label>
									<input type="text" id="add_employee_paternal_surename" class="form-control hm-input" placeholder="Ej. Pérez" v-model="form_add.paternal_surename">
								</div>
							</div>
							<div class="col-6">
								<div class="mb-3">
									<label for="add_employee_maternal_surename" class="form-label">Segundo apellido</label>
									<input type="text" id="add_employee_maternal_surename" class="form-control hm-input" placeholder="Ej. Méndez" v-model="form_add.maternal_surename">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<div class="mb-3">
									<label for="add_eployee_department" class="form-label">Departamento</label>
									<div class="hm-select-wrap">
										<select id="add_eployee_department" class="form-select" v-model="form_add.departments_id">
											<option selected :value="null">Selecciona departamento</option>
											<option v-for="department in departments" :value="department.id">{{ department.name }}</option>
										</select>
										<svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"></path></svg>
									</div>
								</div>
							</div>
							<div class="col-6">
								<div class="mb-3">
									<label for="add_employee_shift" class="form-label">Turno</label>
									<div id="add_employee_shift" class="hm-select-wrap">
										<select class="form-select" v-model="form_add.shifts_id">
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
									<label for="add_employee_phone" class="form-label">Teléfono (10 dígitos)</label>
									<input type="tel" pattern="[0-9]{10}" id="add_employee_phone" class="form-control hm-input" placeholder="Ej. 4411234567" v-model="form_add.phone">
								</div>
							</div>
							<div class="col-6">
								<div class="mb-3">
									<label for="add_employee_address" class="form-label">Dirección</label>
									<input type="text" id="add_employee_address" class="form-control hm-input" placeholder="Ej. Av. Benito Juárez no. 5" v-model="form_add.address">
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
						<h1 class="modal-title fs-5">Editar empleado</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clear_form()"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-6">
								<div class="mb-3">
									<label for="edit_employee_first_name" class="form-label">Nombre</label>
									<input type="text" id="edit_employee_first_name" class="form-control hm-input" placeholder="Ej. Juan" v-model="form_edit.first_name">
								</div>
							</div>
							<div class="col-6">
								<div class="mb-3">
									<label for="edit_employee_middle_name" class="form-label">Segundo nombre</label>
									<input type="text" id="edit_employee_middle_name" class="form-control hm-input" placeholder="Ej. Pedro" v-model="form_edit.middle_name">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<div class="mb-3">
									<label for="edit_employee_paternal_surename" class="form-label">Primer apellido</label>
									<input type="text" id="edit_employee_paternal_surename" class="form-control hm-input" placeholder="Ej. Pérez" v-model="form_edit.paternal_surename">
								</div>
							</div>
							<div class="col-6">
								<div class="mb-3">
									<label for="edit_employee_maternal_surename" class="form-label">Segundo apellido</label>
									<input type="text" id="edit_employee_maternal_surename" class="form-control hm-input" placeholder="Ej. Méndez" v-model="form_edit.maternal_surename">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-4">
								<div class="mb-3">
									<label for="edit_employee_department" class="form-label">Departamento</label>
									<div class="hm-select-wrap">
										<select id="edit_employee_department" class="form-select" v-model="form_edit.departments_id">
											<option selected :value="null">Selecciona departamento</option>
											<option v-for="department in departments" :value="department.id">{{ department.name }}</option>
										</select>
										<svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"></path></svg>
									</div>
								</div>
							</div>
							<div class="col-4">
								<div class="mb-3">
									<label for="edit_employee_shift" class="form-label">Turno</label>
									<div class="hm-select-wrap">
										<select id="edit_employee_shift" class="form-select" v-model="form_edit.shifts_id">
											<option selected :value="null">Selecciona turno</option>
											<option v-for="shift in shifts" :value="shift.id">{{ shift.name }}</option>
										</select>
										<svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"></path></svg>
									</div>
								</div>
							</div>
							<div class="col-4">
								<div class="mb-3">
									<label for="edit_employee_state" class="form-label">Estado</label>
									<div class="hm-select-wrap">
										<select id="edit_employee_state" class="form-select" v-model="form_edit.state">
											<option selected :value="null">Selecciona estado</option>
											<option value="ACTIVE">Activo</option>
											<option value="ON_VACATIONS">En vacaciones</option>
											<option value="ABSENT">Ausente</option>
										</select>
										<svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"></path></svg>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<div class="mb-3">
									<label for="edit_employee_phone" class="form-label">Teléfono</label>
									<input id="edit_employee_phone" type="text" class="form-control hm-input" placeholder="Ej. 4411234567" v-model="form_edit.phone">
								</div>
							</div>
							<div class="col-6">
								<div class="mb-3">
									<label for="edit_employee_address" class="form-label">Dirección</label>
									<input id="edit_employee_address" type="text" class="form-control hm-input" placeholder="Ej. Av. Benito Juárez no. 5" v-model="form_edit.address">
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

	<!-- Modal Delete -->
	<div class="modal " id="delete-modal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<form @submit.prevent="save_delete">
					<div class="modal-header">
						<h1 class="modal-title fs-5">Eliminar empleado</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clear_form()"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<p>¿Seguro que deseas eliminar el empleado <b>{{form_delete.first_name}} {{form_delete.middle_name}} {{form_delete.paternal_surename}} {{form_delete.maternal_surename}}</b>?</p>
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

const registros = ref([]);
const form_delete = ref({});
const departments = ref([]);
const shifts = ref([]);
const form_edit = ref({});
const erroresValidacion = ref({});

const getInitialForm = () => ({
	first_name: null,
	middle_name: null,
	paternal_surename: null,
	maternal_surename: null,
	departments_id: null,
	shifts_id: null,
	phone: null,
	address: null,
	state: 'ACTIVE'
});

const form_add = reactive(getInitialForm());

const headers = {
	'Accept': 'application/json'
};

onMounted(async () => {
	load_records();
	get_departments();
	get_shifts();
});

async function load_records () {
	const { data } = await axios.get('/api/employees', headers);
	registros.value = data;
};

function clear_form() {
	Object.assign(form_add, getInitialForm());
	Object.assign(form_edit, getInitialForm());
	Object.assign(form_delete, getInitialForm());
};

function editar(registro) {
	form_edit.value = structuredClone(toRaw(registro));
};

function eliminar(registro) {
	form_delete.value = structuredClone(toRaw(registro));
};

const get_departments = async () => {
	const response = await axios.get('/api/departments', headers);
	departments.value = response.data;
};

const get_shifts = async () => {
	const response = await axios.get('/api/shifts', headers);
	shifts.value = response.data;
};

const save_add = async () => {

	// form_add.first_name

	try {
		await axios.post(`/api/employees`, form_add, headers);
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
	try {
		await axios.put(`/api/employees`, form_edit.value, headers);
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

				$('#modal-error-title').html('Error al guardar cambios en empleado');
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
	Object.assign(form_edit, getInitialForm());
};

const save_delete = async () => {
	try {
		await axios.delete(`/api/employees/${form_delete.value.id}`, headers);
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