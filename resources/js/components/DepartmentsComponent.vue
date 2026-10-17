<template>

	<div class="row h-100">
		<div class="col-12 h-100">
			<div class="card rounded-4 h-100">
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<div>
							<h5 class="card-title">Departamentos</h5>
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
								<th scope="col" class="text-left">Departamento</th>
								<th scope="col" class="text-left">Descripción</th>
								<th scope="col" class="text-left">Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="record in records" :key="record.id">
								<td><span class="hm-table-text-dark-bold">{{ record.name }}</span></td>
								<td>{{ record.description }}</td>
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
		<div class="modal-dialog">
			<div class="modal-content">
				<form @submit.prevent="fadd">
					<div class="modal-header">
						<h1 class="modal-title fs-5">Editar departamento</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clear_form()"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label for="add_department_name" class="form-label">Nombre del departamento</label>
							<input type="text" id="add_department_name" class="form-control hm-input" placeholder="Ej. Contabilidad" v-model="form_add.name">
							<div id="add_department_name_message_error" class="form-text d-none">Se requiere nombre de departamento</div>
						</div>
						<div class="mb-3">
							<label for="add_department_description" class="form-label">Descripción</label>
							<div class="hm-textarea-wrap" id="add_department_description_wrap">
								<textarea class="form-control hm-textarea" id="add_department_description" placeholder="Ej. Gestiona la contabilidad, compras y ventas" v-model="form_add.description" rows="3"></textarea>
							</div>
							<div id="add_department_description_message_error" class="form-text d-none">Se requiere descripción de departamento</div>
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
		<div class="modal-dialog">
			<div class="modal-content">
				<form @submit.prevent="fedit">
					<div class="modal-header">
						<h1 class="modal-title fs-5">Editar departamento</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clear_form()"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label for="edit_department_name" class="form-label">Nombre del departamento</label>
							<input type="text" id="edit_department_name" class="form-control hm-input" placeholder="Ej. Contabilidad" v-model="form_edit.name">
							<div id="edit_department_name_message_error" class="form-text d-none">Se requiere nombre de departamento</div>
						</div>
						<div class="mb-3">
							<label for="edit_department_description" class="form-label">Descripción</label>
							<div class="hm-textarea-wrap" id="edit_department_description_wrap">
								<textarea class="form-control hm-textarea" id="edit_department_description" placeholder="Ej. Gestiona la contabilidad, compras y ventas" v-model="form_edit.description" style="resize: none" rows="3"></textarea>
							</div>
							<div id="edit_department_description_message_error" class="form-text d-none">Se requiere descripción de departamento</div>
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
						<h1 class="modal-title fs-5">Eliminar departamento</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clear_form()"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<p>¿Seguro que deseas eliminar el departamento <b>{{form_delete.name}}</b>?</p>
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

const getInitialForm = () => ({
	name: '',
	description: ''
});

const records = ref([]);
const form_add = reactive(getInitialForm());
const form_edit = ref({});
const form_delete = ref({});
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
	modal_add = new Modal(modal_add_element.value);
	modal_edit = new Modal(modal_edit_element.value);
});

async function load_records () {
	const { data } = await axios.get('/api/departments', headers);
	records.value = data;
}

function clear_form() {
	
	Object.assign(form_add, getInitialForm());
	Object.assign(form_edit, getInitialForm());
	Object.assign(form_delete, getInitialForm());

	$('#add_department_name').removeClass('hm-input-error');
	$('#add_department_name_message_error').addClass('d-none');
	$('#add_department_description_wrap').removeClass('hm-textarea-wrap-error');
	$('#add_department_description_message_error').addClass('d-none');

	$('#edit_department_name').removeClass('hm-input-error');
	$('#edit_department_name_message_error').addClass('d-none');
	$('#edit_department_description_wrap').removeClass('hm-textarea-wrap-error');
	$('#edit_department_description_message_error').addClass('d-none');
};

function editar(registro) {
	form_edit.value = structuredClone(toRaw(registro));
};

function eliminar(registro) {
	form_delete.value = structuredClone(toRaw(registro));
};

const fadd = async () => {

	$('#add_department_name').removeClass('hm-input-error');
	$('#add_department_name_message_error').addClass('d-none');

	$('#add_department_description_wrap').removeClass('hm-textarea-wrap-error');
	$('#add_department_description_message_error').addClass('d-none');

	let name_validation, description_validation = false;

	if(form_add.name == null || form_add.name.length == 0) {
		$('#add_department_name').addClass('hm-input-error');
		$('#add_department_name_message_error').removeClass('d-none');
	}
	else {
		name_validation = true;
	}

	if(form_add.description == null || form_add.description.length == 0) {
		$('#add_department_description_wrap').addClass('hm-textarea-wrap-error');
		$('#add_department_description_message_error').removeClass('d-none');
	}
	else {
		description_validation = true;
	}

	if(name_validation && description_validation) {
		try {
			let { data } = await axios.post(`/api/departments`, form_add, headers);
			records.value.push(data);
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

	$('#edit_department_name').removeClass('hm-input-error');
	$('#edit_department_name_message_error').addClass('d-none');

	$('#edit_department_description_wrap').removeClass('hm-textarea-wrap-error');
	$('#edit_department_description_message_error').addClass('d-none');

	let name_validation, description_validation = false;

	if(form_edit.value.name == null || form_edit.value.name.length == 0) {
		$('#edit_department_name').addClass('hm-input-error');
		$('#edit_department_name_message_error').removeClass('d-none');
	}
	else {
		name_validation = true;
	}

	if(form_edit.value.description == null || form_edit.value.description.length == 0) {
		$('#edit_department_description_wrap').addClass('hm-textarea-wrap-error');
		$('#edit_department_description_message_error').removeClass('d-none');
	}
	else {
		description_validation = true;
	}

	if(name_validation && description_validation) {
		try {
			let { data } = await axios.put(`/api/departments`, form_edit.value, headers);
			for(var i = 0; i < records.value.length; i++) {
				if(records.value[i].id == data.id) {
					records.value[i] = data;
				}
			}
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

			$('#modal-error-title').html('Error al guardar cambios en departamento');
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
		let buffer_id = form_delete.value.id;
		await axios.delete(`/api/departments/${form_delete.value.id}`, headers);
		for(var i = 0; i < records.value.length; i++) {
			if(records.value[i].id == buffer_id) {
				records.value.splice(i, 1);
			}
		}
	}
	catch(error) {
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

		$('#modal-error-title').html('Error al guardar cambios en departamento');
		$('#modal-error-description').html('Al guardar el registro se presentó un problema. Intente nuevamente y en caso de persistir reporte el problema.');
		$('#modal-error-code').html(error_description);
		const errorModal = new bootstrap.Modal('#modal-error', options);
		errorModal.show();
	}
	Object.assign(form_delete, getInitialForm())
};

</script>