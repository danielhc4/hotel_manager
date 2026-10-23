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
							<tr v-for="record in records" :key="record.id">
								<td><span class="hm-table-text-dark-bold">{{ record.name }}</span></td>
								<td>
									<img v-if="record.activity_type === 'DAILY'" :src="`${ assetUrl }/daily_recurring_task_icon.svg`" title="Diaria" style="width: 25px;">
									<img v-else :src="`${ assetUrl }/sporadic_activity_icon.svg`" title="Extra" style="width: 25px;">
								</td>
								<td>{{ record.description }}</td>
								<td>
									<span v-if="record.departments_id !== null" class="badge hm-table-badge hm-table-badge-color-oak">
										{{ record.department.name }}
									</span>
									<span v-else class="badge hm-table-badge hm-table-badge-color-gold">
										General
									</span>
								</td>
								<td>{{ record.shift.name }}</td>
								<td v-if="record.employee">
									Confianza
									<span class="badge hm-table-badge hm-table-badge-color-sort">
										<span v-if="record.employee.state === 'ACTIVE'" class="hm-dot-badge active"></span>
										<span v-if="record.employee.state === 'ON_VACATIONS'" class="hm-dot-badge on-vacations"></span>
										<span v-if="record.employee.state === 'ABSENT'" class="hm-dot-badge absent"></span>
										{{ record.employee.first_name }} {{ record.employee.middle_name }} {{ record.employee.paternal_surename }} {{ record.employee.maternal_surename }}
									</span>
								</td>
								<td v-else>Normal</td>
								<td class="d-flex">
									<button @click="editar(record)" type="button" class="hm-icon-btn" data-bs-toggle="modal" data-bs-target="#edit-modal">
										<svg viewBox="0 0 24 24">
											<path d="M12 20h9"></path>
											<path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"></path>
										</svg>
									</button>
									<button @click="eliminar(record)" type="button" class="hm-icon-btn" data-bs-toggle="modal" data-bs-target="#delete-modal">
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
	<div class="modal fade" id="add-modal" ref="modal_add_element" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form @submit.prevent="fadd">
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
									<div id="add_activity_name_message_error" class="form-text d-none">Se requiere nombre de actividad</div>
								</div>
							</div>
							<div class="col-6">
								<div class="mb-3">
									<label for="add_activity_shift" class="form-label">Turno</label>
									<div class="hm-select-wrap">
										<select class="form-select" id="add_activity_shift" @change="get_employees_by_department(form_add.departments_id)" v-model="form_add.shifts_id">
											<option selected :value="null">Selecciona turno</option>
											<option v-for="shift in shifts" :value="shift.id">{{ shift.name }}</option>
										</select>
										<svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"></path></svg>
									</div>
									<div id="add_activity_shift_message_error" class="form-text d-none">Se requiere turno de actividad</div>
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
									<div id="add_activity_type_message_error" class="form-text d-none">Se requiere tipo de actividad</div>
								</div>
							</div>
							<div class="col-6">
								<div class="mb-3">
									<label for="add_activity_department" class="form-label">Departamento</label>
									<div class="hm-select-wrap">
										<select class="form-select" id="add_activity_department" @change="get_employees_by_department(form_add.departments_id)" v-model="form_add.departments_id">
											<option selected :value="null">Actividad general</option>
											<option v-for="department in departments" :value="department.id">{{ department.name }}</option>
										</select>
										<svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"></path></svg>
									</div>
									<div id="add_activity_department_message_error" class="form-text d-none">Se requiere departamento</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="mb-3">
									<label for="add_activity_description" class="form-label">Descripción</label>
									<div class="hm-textarea-wrap" id="add_activity_description_wrap">
										<textarea id="add_activity_description" class="form-control hm-textarea" placeholder="Ej. Hacer la limpieza completa de baños"  v-model="form_add.description" rows="3"></textarea>
									</div>
									<div id="add_activity_description_message_error" class="form-text d-none">Se requiere descripción de departamento</div>
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
									<div id="add_activity_trust_message_error" class="form-text d-none">Se requiere especificar si es actividad de confianza.</div>
								</div>
							</div>
							<div class="col-6" v-if="form_add.trusted === 'TRUSTED'">
								<div class="mb-3">
									<label for="add_activity_trusted_employee" class="form-label">Empleado de confianza</label>
									<div class="hm-select-wrap">
										<select class="form-select" id="add_activity_trusted_employee" v-model="form_add.employees_id">
											<option selected :value="null">Empleado de confianza</option>
											<option v-for="employee in employees" :value="employee.id">{{ employee.first_name }} {{ employee.middle_name }} {{ employee.paternal_surename }} {{ employee.maternal_surename }} ({{ employee.shift.name }}) </option>
										</select>
										<svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"></path></svg>
									</div>
									<div id="add_activity_trusted_employee_message_error" class="form-text d-none">Si la actividad es de confianza se tiene que elegir un empleado.</div>
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

	<!-- Modal Edit -->
	<div class="modal fade" id="edit-modal" ref="modal_edit_element" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form @submit.prevent="fedit">
					<div class="modal-header">
						<h1 class="modal-title fs-5">Editar actividad</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clear_form()"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-6">
								<div class="mb-3">
									<label for="edit_activity_name" class="form-label">Nombre de actividad</label>
									<input type="text" id="edit_activity_name" class="form-control hm-input" placeholder="Ej. Limpiar baños" v-model="form_edit.name">
									<div id="edit_activity_name_message_error" class="form-text d-none">Se requiere nombre de actividad</div>
								</div>
							</div>
							<div class="col-6">
								<div class="mb-3">
									<label for="edit_activity_shift" class="form-label">Turno</label>
									<div class="hm-select-wrap">
										<select class="form-select" id="edit_activity_shift" @change="get_employees_by_department(form_edit.departments_id)" v-model="form_edit.shifts_id">
											<option selected :value="null">Selecciona turno</option>
											<option v-for="shift in shifts" :value="shift.id">{{ shift.name }}</option>
										</select>
										<svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"></path></svg>
									</div>
									<div id="edit_activity_shift_message_error" class="form-text d-none">Se requiere turno de actividad</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<div class="mb-3">
									<label for="edit_activity_type" class="form-label">Tipo de actividad</label>
									<div class="hm-select-wrap">
										<select class="form-select" id="edit_activity_type" v-model="form_edit.activity_type">
											<option selected :value="null">Selecciona tipo de actividad</option>
											<option value="DAILY">Diaria</option>
											<option value="EXTRA">Extra</option>
										</select>
										<svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"></path></svg>
									</div>
									<div id="edit_activity_type_message_error" class="form-text d-none">Se requiere tipo de actividad</div>
								</div>
							</div>
							<div class="col-6">
								<div class="mb-3">
									<label for="edit_activity_department" class="form-label">Departamento</label>
									<div class="hm-select-wrap">
										<select class="form-select" id="edit_activity_department" @change="get_employees_by_department(form_edit.departments_id)" v-model="form_edit.departments_id">
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
									<label for="edit_activity_description" class="form-label">Descripción</label>
									<div class="hm-textarea-wrap">
										<textarea id="edit_activity_description" class="form-control hm-textarea" placeholder="Ej. Hacer limpieza de baños" v-model="form_edit.description" rows="3"></textarea>
									</div>
								</div>
								<div id="edit_activity_description_message_error" class="form-text d-none">Se requiere descripción de departamento</div>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<div class="mb-3">
									<label for="edit_activity_trust" class="form-label">Actividad de confianza</label>
									<div class="hm-select-wrap">
										<select class="form-select" id="edit_activity_trust" @change="get_employees_by_department(form_edit.departments_id)" v-model="form_edit.trusted">
											<option selected :value="null">Actividad de confianza</option>
											<option value="TRUSTED">Sí</option>
											<option value="NO_TRUSTED">No</option>
										</select>
										<svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"></path></svg>
									</div>
									<div id="edit_activity_trust_message_error" class="form-text d-none">Se requiere especificar si es actividad de confianza.</div>
								</div>
							</div>
							<div class="col-6" v-if="form_edit.trusted === 'TRUSTED'">
								<div class="mb-3">
									<label for="edit_activity_trusted_employee" class="form-label">Empleado de confianza</label>
									<div class="hm-select-wrap">
										<select class="form-select" id="edit_activity_trusted_employee" v-model="form_edit.employees_id">
											<option selected :value="null">Empleado de confianza</option>
											<option v-for="employee in employees" :value="employee.id">{{ employee.first_name }} {{ employee.middle_name }} {{ employee.paternal_surename }} {{ employee.maternal_surename }}</option>
										</select>
										<svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"></path></svg>
									</div>
									<div id="edit_activity_trusted_employee_message_error" class="form-text d-none">Si la actividad es de confianza se tiene que elegir un empleado.</div>
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
	<div class="modal fade" id="delete-modal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<form @submit.prevent="fdelete">
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
import { Modal } from 'bootstrap';

const props = defineProps({
	assetUrl: {
		type: String,
		require: true
	}
});

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

const records = ref([]);
const shifts = ref([]);
const departments = ref([]);
const form_edit = reactive(getInitialForm());
const form_add = reactive(getInitialForm());
const form_delete = ref({});
const employees = ref([]);
const erroresValidacion = ref({});

const modal_add_element = ref(null);
const modal_edit_element = ref(null);

let modal_add = null;
let modal_edit = null;

const headers = {
	'Accept': 'application/json'
};

onMounted(async () => {
	load_records();
	get_shifts();
	get_departments();

	modal_add = new Modal(modal_add_element.value);
	modal_edit = new Modal(modal_edit_element.value);
});

async function load_records () {
	const { data } = await axios.get(`/api/activities`, headers);
	records.value = data;
};

const get_shifts = async () => {
	const { data } = await axios.get(`/api/shifts`, headers);
	shifts.value = data;
};

const get_departments = async () => {
	const { data } = await axios.get(`/api/departments`, headers);
	departments.value = data;
};

function clear_form() {

	Object.assign(form_add, getInitialForm());
	Object.assign(form_edit, getInitialForm());
	Object.assign(form_delete, getInitialForm());

	$('#add_activity_name').removeClass('hm-input-error');
	$('#add_activity_name_message_error').addClass('d-none');
	$('#add_activity_shift').removeClass('hm-select-error');
	$('#add_activity_shift_message_error').addClass('d-none');
	$('#add_activity_type').removeClass('hm-select-error');
	$('#add_activity_type_message_error').addClass('d-none');
	$('#add_activity_description_wrap').removeClass('hm-textarea-wrap-error');
	$('#add_activity_description_message_error').addClass('d-none');
	$('#add_activity_trust').removeClass('hm-select-error');
	$('#add_activity_trust_message_error').addClass('d-none');
	$('#add_activity_trusted_employee').removeClass('hm-select-error');
	$('#add_activity_trusted_employee_message_error').addClass('d-none');

	$('#edit_activity_name').removeClass('hm-input-error');
	$('#edit_activity_name_message_error').addClass('d-none');
	$('#edit_activity_shift').removeClass('hm-select-error');
	$('#edit_activity_shift_message_error').addClass('d-none');
	$('#edit_activity_type').removeClass('hm-select-error');
	$('#edit_activity_type_message_error').addClass('d-none');
	$('#edit_activity_description_wrap').removeClass('hm-textarea-wrap-error');
	$('#edit_activity_description_message_error').addClass('d-none');
	$('#edit_activity_trust').removeClass('hm-select-error');
	$('#edit_activity_trust_message_error').addClass('d-none');
	$('#edit_activity_trusted_employee').removeClass('hm-select-error');
	$('#edit_activity_trusted_employee_message_error').addClass('d-none');

};

const get_employees_by_department = async (departament_id) => {
	if(departament_id !== null || departament_id !== undefined) {
		const { data } = await axios.get(`/api/employees?campo=departments_id&q=${departament_id}`, headers);
		var employee_filtered = [];
		if(form_add.shifts_id == null && form_edit.shifts_id == null) {
			employees.value = data;
		}
		else {
			for(var i = 0; i < data.length; i++) {
				if(form_add.shifts_id !== null) {
					if(data[i].shifts_id == form_add.shifts_id) {
						employee_filtered.push(data[i]);
					}
				}
				if(form_edit.shifts_id !== null) {
					if(data[i].shifts_id == form_edit.shifts_id) {
						employee_filtered.push(data[i]);
					}
				}
			}
			employees.value = employee_filtered;
		}
	}
};

function editar(registro) {
	Object.assign(form_edit, registro);
	form_edit.trusted = registro.employees_id == null ? 'NO_TRUSTED' : 'TRUSTED';
};

function eliminar(registro) {
	form_delete.value = structuredClone(toRaw(registro));
};

const fadd = async () => {

	$('#add_activity_name').removeClass('hm-input-error');
	$('#add_activity_name_message_error').addClass('d-none');
	$('#add_activity_shift').removeClass('hm-select-error');
	$('#add_activity_shift_message_error').addClass('d-none');
	$('#add_activity_type').removeClass('hm-select-error');
	$('#add_activity_type_message_error').addClass('d-none');
	$('#add_activity_description_wrap').removeClass('hm-textarea-wrap-error');
	$('#add_activity_description_message_error').addClass('d-none');
	$('#add_activity_trust').removeClass('hm-select-error');
	$('#add_activity_trust_message_error').addClass('d-none');
	$('#add_activity_trusted_employee').removeClass('hm-select-error');
	$('#add_activity_trusted_employee_message_error').addClass('d-none');

	let name_validation, shift_validation, type_validation, description_validation, trust_validation, trusted_validation = false;

	if(form_add.name == null || form_add.name.length == 0) {
		$('#add_activity_name').addClass('hm-input-error');
		$('#add_activity_name_message_error').removeClass('d-none');
	}
	else {
		name_validation = true;
	}

	if(form_add.shifts_id == null) {
		$('#add_activity_shift').addClass('hm-select-error');
		$('#add_activity_shift_message_error').removeClass('d-none');
	}
	else {
		shift_validation = true;
	}

	if(form_add.activity_type == null) {
		$('#add_activity_type').addClass('hm-select-error');
		$('#add_activity_type_message_error').removeClass('d-none');
	}
	else {
		type_validation = true;
	}

	if(form_add.description == null || form_add.description.length == 0) {
		$('#add_activity_description_wrap').addClass('hm-textarea-wrap-error');
		$('#add_activity_description_message_error').removeClass('d-none');
	}
	else {
		description_validation = true;
	}

	if(form_add.trusted == null) {
		$('#add_activity_trust').addClass('hm-select-error');
		$('#add_activity_trust_message_error').removeClass('d-none');
	}
	else {
		trust_validation = true;
	}

	if(form_add.trusted == 'TRUSTED' && form_add.employees_id == null) {
		$('#add_activity_trusted_employee').addClass('hm-select-error');
		$('#add_activity_trusted_employee_message_error').removeClass('d-none');
	}
	else {
		trusted_validation = true;
	}
	

	if(name_validation && shift_validation && type_validation && description_validation && trust_validation && trusted_validation) {
		try {
			await axios.post(`/api/activities`, form_add, headers);
			load_records();
			modal_add.hide();
		}
		catch(error) {
			modal_add.hide();
			erroresValidacion.value = error.response.data.errors;
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
		clear_form();
	}
};

const fedit = async () => {

	$('#edit_activity_name').removeClass('hm-input-error');
	$('#edit_activity_name_message_error').addClass('d-none');
	$('#edit_activity_shift').removeClass('hm-select-error');
	$('#edit_activity_shift_message_error').addClass('d-none');
	$('#edit_activity_type').removeClass('hm-select-error');
	$('#edit_activity_type_message_error').addClass('d-none');
	$('#edit_activity_description_wrap').removeClass('hm-textarea-wrap-error');
	$('#edit_activity_description_message_error').addClass('d-none');
	$('#edit_activity_trust').removeClass('hm-select-error');
	$('#edit_activity_trust_message_error').addClass('d-none');
	$('#edit_activity_trusted_employee').removeClass('hm-select-error');
	$('#edit_activity_trusted_employee_message_error').addClass('d-none');

	let name_validation, shift_validation, type_validation, description_validation, trust_validation, trusted_validation = false;

	if(form_edit.name == null || form_edit.name.length == 0) {
		$('#edit_activity_name').addClass('hm-input-error');
		$('#edit_activity_name_message_error').removeClass('d-none');
	}
	else {
		name_validation = true;
	}

	if(form_edit.shifts_id == null) {
		$('#edit_activity_shift').addClass('hm-select-error');
		$('#edit_activity_shift_message_error').removeClass('d-none');
	}
	else {
		shift_validation = true;
	}

	if(form_edit.activity_type == null) {
		$('#edit_activity_type').addClass('hm-select-error');
		$('#edit_activity_type_message_error').removeClass('d-none');
	}
	else {
		type_validation = true;
	}

	if(form_edit.description == null || form_edit.description.length == 0) {
		$('#edit_activity_description_wrap').addClass('hm-textarea-wrap-error');
		$('#edit_activity_description_message_error').removeClass('d-none');
	}
	else {
		description_validation = true;
	}

	if(form_edit.trusted == null) {
		$('#edit_activity_trust').addClass('hm-select-error');
		$('#edit_activity_trust_message_error').removeClass('d-none');
	}
	else {
		trust_validation = true;
	}

	if(form_edit.trusted == 'TRUSTED' && form_edit.employees_id == null) {
		$('#edit_activity_trusted_employee').addClass('hm-select-error');
		$('#edit_activity_trusted_employee_message_error').removeClass('d-none');
	}
	else if(form_edit.trusted == 'NO_TRUSTED' && form_edit.employees_id !== null) {
		form_edit.employees_id = null;
		trusted_validation = true;
	}
	else if(form_edit.trusted == 'NO_TRUSTED' && form_edit.employees_id == null) {
		trusted_validation = true;
	}
	else {
		trusted_validation = true;
	}

	if(name_validation && shift_validation && type_validation && description_validation && trust_validation && trusted_validation) {
		console.log(form_edit);
		try {
			await axios.put(`/api/activities`, form_edit, headers);
			load_records();
			modal_edit.hide();
		}
		catch(error) {
			modal_edit.hide();
			erroresValidacion.value = error.response.data.errors;
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
		clear_form();
	}
};

const fdelete = async () => {
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