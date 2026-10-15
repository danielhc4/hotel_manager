<template>

	<div class="row h-100">
		<div class="col-12 h-100">
			<div class="card rounded-4 h-100">
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<div>
							<h5 class="card-title">Horarios</h5>
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
								<th scope="col" rowspan="2" class="text-center">Turnos</th>
								<th scope="colgroup" colspan="7" class="text-center">Horarios</th>
								<th scope="col" rowspan="2" class="text-center">Acciones</th>
							</tr>
							<tr>
								<th scope="col" class="text-center">Lunes</th>
								<th scope="col" class="text-center">Martes</th>
								<th scope="col" class="text-center">Miércoles</th>
								<th scope="col" class="text-center">Jueves</th>
								<th scope="col" class="text-center">Viernes</th>
								<th scope="col" class="text-center">Sábado</th>
								<th scope="col" class="text-center">Domingo</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="record in records" :key="record.id">

								<!-- Name -->
								<td><span class="hm-table-text-dark-bold">{{ record.name }}</span></td>
								
								<!-- Monday -->
								<td v-if="record.monday_shift_entry">
									<span class="badge rounded-pill hm-table-badge hm-table-badge-color-oak-soft">{{ record.monday_shift_entry }}</span>
									<span class="badge rounded-pill hm-table-badge hm-table-badge-color-coral">{{ record.monday_shift_ending }}</span>
								</td>
								<td v-else>
									<span class="badge rounded-pill hm-table-badge hm-table-badge-color-gold">Descanso</span>
								</td>

								<!-- Tuesday -->
								<td v-if="record.tuesday_shift_entry">
									<span class="badge rounded-pill hm-table-badge hm-table-badge-color-oak-soft">{{ record.tuesday_shift_entry }}</span>
									<span class="badge rounded-pill hm-table-badge hm-table-badge-color-coral">{{ record.tuesday_shift_ending }}</span>
								</td>
								<td v-else>
									<span class="badge rounded-pill hm-table-badge hm-table-badge-color-gold">Descanso</span>
								</td>

								<!-- Wednesday -->
								<td v-if="record.wednesday_shift_entry">
									<span class="badge rounded-pill hm-table-badge hm-table-badge-color-oak-soft">{{ record.wednesday_shift_entry }}</span>
									<span class="badge rounded-pill hm-table-badge hm-table-badge-color-coral">{{ record.wednesday_shift_ending }}</span>
								</td>
								<td v-else>
									<span class="badge rounded-pill hm-table-badge hm-table-badge-color-gold">Descanso</span>
								</td>

								<!-- Thursday -->
								<td v-if="record.thursday_shift_entry">
									<span class="badge rounded-pill hm-table-badge hm-table-badge-color-oak-soft">{{ record.thursday_shift_entry }}</span>
									<span class="badge rounded-pill hm-table-badge hm-table-badge-color-coral">{{ record.thursday_shift_ending }}</span>
								</td>
								<td v-else>
									<span class="badge rounded-pill hm-table-badge hm-table-badge-color-gold">Descanso</span>
								</td>

								<!-- Friday -->
								<td v-if="record.friday_shift_entry">
									<span class="badge rounded-pill hm-table-badge hm-table-badge-color-oak-soft">{{ record.friday_shift_entry }}</span>
									<span class="badge rounded-pill hm-table-badge hm-table-badge-color-coral">{{ record.friday_shift_ending }}</span>
								</td>
								<td v-else>
									<span class="badge rounded-pill hm-table-badge hm-table-badge-color-gold">Descanso</span>
								</td>

								<!-- Saturday -->
								<td v-if="record.saturday_shift_entry">
									<span class="badge rounded-pill hm-table-badge hm-table-badge-color-oak-soft">{{ record.saturday_shift_entry }}</span>
									<span class="badge rounded-pill hm-table-badge hm-table-badge-color-coral">{{ record.saturday_shift_ending }}</span>
								</td>
								<td v-else>
									<span class="badge rounded-pill hm-table-badge hm-table-badge-color-gold">Descanso</span>
								</td>

								<!-- Sunday -->
								<td v-if="record.sunday_shift_entry">
									<span class="badge rounded-pill hm-table-badge hm-table-badge-color-oak-soft">{{ record.sunday_shift_entry }}</span>
									<span class="badge rounded-pill hm-table-badge hm-table-badge-color-coral">{{ record.sunday_shift_ending }}</span>
								</td>
								<td v-else>
									<span class="badge rounded-pill hm-table-badge hm-table-badge-color-gold">Descanso</span>
								</td>

								<!-- Options -->
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
				<form @submit.prevent="fadd" class="hm-grid-form">
					<div class="modal-header">
						<h1 class="modal-title fs-5">Agregar turno</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clear_form()"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label for="add_shift_name" class="form-label">Nombre de turno</label>
							<input type="text" id="add_shift_name" class="form-control hm-input" placeholder="Ej. Turno matutino" v-model="form_add.name">
							<div id="add_shift_name_message_error" class="form-text d-none">Inconsistencia al guardar horario de día lunes. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
						</div>
						<div class="mb-3 p-3 hm-grid-form-table">
							<div class="row">
								<div class="col-4 m-0 p-0"><span>Día</span></div>
								<div class="col-4 m-0 p-0"><span>Entrada</span></div>
								<div class="col-4 m-0 p-0"><span>Salida</span></div>
							</div>
							<div class="row">
								<div class="col-4 m-0 p-0">
									<div class="hm-grid-form-vhead">
										<span class="hm-text-dot-oak"></span>Lunes
									</div>
								</div>
								<div class="col-4 m-0 p-0">
									<div class="hm-select-wrap">
										<select class="form-select" id="add_monday_entry" v-model="form_add.monday_shift_entry">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-4">
									<div class="hm-select-wrap">
										<select class="form-select" id="add_monday_ending" v-model="form_add.monday_shift_ending">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-8 offset-4">
									<div id="add_monday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día lunes. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
								</div>
							</div>
							<div class="row">
								<div class="col-4 m-0 p-0">
									<div class="hm-grid-form-vhead">
										<span class="hm-text-dot-oak"></span>Martes
									</div>
								</div>
								<div class="col-4 m-0 p-0">
									<div class="hm-select-wrap">
										<select class="form-select" id="add_tuesday_entry" v-model="form_add.tuesday_shift_entry">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-4">
									<div class="hm-select-wrap">
										<select class="form-select" id="add_tuesday_ending" v-model="form_add.tuesday_shift_ending">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-8 offset-4">
									<div id="add_tuesday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día martes. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
								</div>
							</div>
							<div class="row">
								<div class="col-4 m-0 p-0">
									<div class="hm-grid-form-vhead">
										<span class="hm-text-dot-oak"></span>Miércoles
									</div>
								</div>
								<div class="col-4 m-0 p-0">
									<div class="hm-select-wrap">
										<select class="form-select" id="add_wednesday_entry" v-model="form_add.wednesday_shift_entry">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-4">
									<div class="hm-select-wrap">
										<select class="form-select" id="add_wednesday_ending" v-model="form_add.wednesday_shift_ending">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-8 offset-4">
									<div id="add_wednesday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día miércoles. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
								</div>
							</div>
							<div class="row">
								<div class="col-4 m-0 p-0">
									<div class="hm-grid-form-vhead">
										<span class="hm-text-dot-oak"></span>Jueves
									</div>
								</div>
								<div class="col-4 m-0 p-0">
									<div class="hm-select-wrap">
										<select class="form-select" id="add_thursday_entry" v-model="form_add.thursday_shift_entry">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-4">
									<div class="hm-select-wrap">
										<select class="form-select" id="add_thursday_ending" v-model="form_add.thursday_shift_ending">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-8 offset-4">
									<div id="add_thursday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día jueves. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
								</div>
							</div>
							<div class="row">
								<div class="col-4 m-0 p-0">
									<div class="hm-grid-form-vhead">
										<span class="hm-text-dot-oak"></span>Viernes
									</div>
								</div>
								<div class="col-4 m-0 p-0">
									<div class="hm-select-wrap">
										<select class="form-select" id="add_friday_entry" v-model="form_add.friday_shift_entry">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-4">
									<div class="hm-select-wrap">
										<select class="form-select" id="add_friday_ending" v-model="form_add.friday_shift_ending">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-8 offset-4">
									<div id="add_friday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día viernes. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
								</div>
							</div>
							<div class="row">
								<div class="col-4 m-0 p-0">
									<div class="hm-grid-form-vhead">
										<span class="hm-text-dot-oak"></span>Sábado
									</div>
								</div>
								<div class="col-4 m-0 p-0">
									<div class="hm-select-wrap">
										<select class="form-select" id="add_saturday_entry" v-model="form_add.saturday_shift_entry">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-4">
									<div class="hm-select-wrap">
										<select class="form-select" id="add_saturday_ending" v-model="form_add.saturday_shift_ending">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-8 offset-4">
									<div id="add_saturday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día sábado. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
								</div>
							</div>
							<div class="row">
								<div class="col-4 m-0 p-0">
									<div class="hm-grid-form-vhead">
										<span class="hm-text-dot-oak"></span>Domingo
									</div>
								</div>
								<div class="col-4 m-0 p-0">
									<div class="hm-select-wrap">
										<select class="form-select" id="add_sunday_entry" v-model="form_add.sunday_shift_entry">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-4">
									<div class="hm-select-wrap">
										<select class="form-select" id="add_sunday_ending" v-model="form_add.sunday_shift_ending">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-8 offset-4">
									<div id="add_sunday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día domingo. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
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
	<div class="modal fade" id="edit-modal" ref="modal_edit_element"  tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form @submit.prevent="fedit" class="hm-grid-form">
					<div class="modal-header">
						<h1 class="modal-title fs-5">Editar turno</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clear_form()"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label for="edit_shift_name" class="form-label">Nombre de turno</label>
							<input type="text" id="edit_shift_name" class="form-control hm-input" placeholder="Ej. Turno matutino" v-model="form_edit.name">
							<div id="edit_shift_name_message_error" class="form-text d-none">Inconsistencia al guardar horario de día lunes. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
						</div>
						<div class="mb-3 p-3 hm-grid-form-table">
							<div class="row">
								<div class="col-4 m-0 p-0"><span>Día</span></div>
								<div class="col-4 m-0 p-0"><span>Entrada</span></div>
								<div class="col-4 m-0 p-0"><span>Salida</span></div>
							</div>
							<div class="row">
								<div class="col-4 m-0 p-0">
									<div class="hm-grid-form-vhead">
										<span class="hm-text-dot-oak"></span>Lunes
									</div>
								</div>
								<div class="col-4 m-0 p-0">
									<div class="hm-select-wrap">
										<select class="form-select" id="edit_monday_entry" v-model="form_edit.monday_shift_entry">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-4">
									<div class="hm-select-wrap">
										<select class="form-select" id="edit_monday_ending" v-model="form_edit.monday_shift_ending">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-8 offset-4">
									<div id="edit_monday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día lunes. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
								</div>
							</div>
							<div class="row">
								<div class="col-4 m-0 p-0">
									<div class="hm-grid-form-vhead">
										<span class="hm-text-dot-oak"></span>Martes
									</div>
								</div>
								<div class="col-4 m-0 p-0">
									<div class="hm-select-wrap">
										<select class="form-select" id="edit_tuesday_entry" v-model="form_edit.tuesday_shift_entry">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-4">
									<div class="hm-select-wrap">
										<select class="form-select" id="edit_tuesday_ending" v-model="form_edit.tuesday_shift_ending">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-8 offset-4">
									<div id="edit_tuesday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día martes. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
								</div>
							</div>
							<div class="row">
								<div class="col-4 m-0 p-0">
									<div class="hm-grid-form-vhead">
										<span class="hm-text-dot-oak"></span>Miércoles
									</div>
								</div>
								<div class="col-4 m-0 p-0">
									<div class="hm-select-wrap">
										<select class="form-select" id="edit_wednesday_entry" v-model="form_edit.wednesday_shift_entry">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-4">
									<div class="hm-select-wrap">
										<select class="form-select" id="edit_wednesday_ending" v-model="form_edit.wednesday_shift_ending">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-8 offset-4">
									<div id="edit_wednesday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día miércoles. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
								</div>
							</div>
							<div class="row">
								<div class="col-4 m-0 p-0">
									<div class="hm-grid-form-vhead">
										<span class="hm-text-dot-oak"></span>Jueves
									</div>
								</div>
								<div class="col-4 m-0 p-0">
									<div class="hm-select-wrap">
										<select class="form-select" id="edit_thursday_entry" v-model="form_edit.thursday_shift_entry">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-4">
									<div class="hm-select-wrap">
										<select class="form-select" id="edit_thursday_ending" v-model="form_edit.thursday_shift_ending">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-8 offset-4">
									<div id="edit_thursday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día jueves. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
								</div>
							</div>
							<div class="row">
								<div class="col-4 m-0 p-0">
									<div class="hm-grid-form-vhead">
										<span class="hm-text-dot-oak"></span>Viernes
									</div>
								</div>
								<div class="col-4 m-0 p-0">
									<div class="hm-select-wrap">
										<select class="form-select" id="edit_friday_entry" v-model="form_edit.friday_shift_entry">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-4">
									<div class="hm-select-wrap">
										<select class="form-select" id="edit_friday_ending" v-model="form_edit.friday_shift_ending">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-8 offset-4">
									<div id="edit_friday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día viernes. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
								</div>
							</div>
							<div class="row">
								<div class="col-4 m-0 p-0">
									<div class="hm-grid-form-vhead">
										<span class="hm-text-dot-oak"></span>Sábado
									</div>
								</div>
								<div class="col-4 m-0 p-0">
									<div class="hm-select-wrap">
										<select class="form-select" id="edit_saturday_entry" v-model="form_edit.saturday_shift_entry">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-4">
									<div class="hm-select-wrap">
										<select class="form-select" id="edit_saturday_ending" v-model="form_edit.saturday_shift_ending">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-8 offset-4">
									<div id="edit_saturday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día sábado. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
								</div>
							</div>
							<div class="row">
								<div class="col-4 m-0 p-0">
									<div class="hm-grid-form-vhead">
										<span class="hm-text-dot-oak"></span>Domingo
									</div>
								</div>
								<div class="col-4 m-0 p-0">
									<div class="hm-select-wrap">
										<select class="form-select" id="edit_sunday_entry" v-model="form_edit.sunday_shift_entry">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-4">
									<div class="hm-select-wrap">
										<select class="form-select" id="edit_sunday_ending" v-model="form_edit.sunday_shift_ending">
											<option :value="null" selected>Descanso</option>
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
								<div class="col-8 offset-4">
									<div id="edit_sunday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día domingo. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
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
						<h1 class="modal-title fs-5">Eliminar turno</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clear_form()"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<p>¿Seguro que deseas eliminar el turno <b>{{form_delete.name}}</b>?</p>
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
	monday_shift_entry: null,
	monday_shift_ending: null,
	tuesday_shift_entry: null,
	tuesday_shift_ending: null,
	wednesday_shift_entry: null,
	wednesday_shift_ending: null,
	thursday_shift_entry: null,
	thursday_shift_ending: null,
	friday_shift_entry: null,
	friday_shift_ending: null,
	saturday_shift_entry: null,
	saturday_shift_ending: null,
	sunday_shift_entry: null,
	sunday_shift_ending: null
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
	const { data } = await axios.get(`/api/shifts`, headers);
	records.value = data;
};

function clear_form() {

	Object.assign(form_add, getInitialForm());
	Object.assign(form_edit, getInitialForm());
	Object.assign(form_delete, getInitialForm());

	$('#add_shift_name').removeClass('hm-input-error');
	$('#add_monday_entry').removeClass('hm-grid-form-select-error');
	$('#add_monday_ending').removeClass('hm-grid-form-select-error');
	$('#add_tuesday_entry').removeClass('hm-grid-form-select-error');
	$('#add_tuesday_ending').removeClass('hm-grid-form-select-error');
	$('#add_wednesday_entry').removeClass('hm-grid-form-select-error');
	$('#add_wednesday_ending').removeClass('hm-grid-form-select-error');
	$('#add_thursday_entry').removeClass('hm-grid-form-select-error');
	$('#add_thursday_ending').removeClass('hm-grid-form-select-error');
	$('#add_friday_entry').removeClass('hm-grid-form-select-error');
	$('#add_friday_ending').removeClass('hm-grid-form-select-error');
	$('#add_saturday_entry').removeClass('hm-grid-form-select-error');
	$('#add_saturday_ending').removeClass('hm-grid-form-select-error');
	$('#add_sunday_entry').removeClass('hm-grid-form-select-error');
	$('#add_sunday_ending').removeClass('hm-grid-form-select-error');
	$('#add_shift_name_message_error').addClass('d-none');
	$('#add_monday_shift_message_error').addClass('d-none');
	$('#add_tuesday_shift_message_error').addClass('d-none');
	$('#add_wednesday_shift_message_error').addClass('d-none');
	$('#add_thursday_shift_message_error').addClass('d-none');
	$('#add_friday_shift_message_error').addClass('d-none');
	$('#add_saturday_shift_message_error').addClass('d-none');
	$('#add_sunday_shift_message_error').addClass('d-none');

	$('#edit_shift_name').removeClass('hm-input-error');
	$('#edit_monday_entry').removeClass('hm-grid-form-select-error');
	$('#edit_monday_ending').removeClass('hm-grid-form-select-error');
	$('#edit_tuesday_entry').removeClass('hm-grid-form-select-error');
	$('#edit_tuesday_ending').removeClass('hm-grid-form-select-error');
	$('#edit_wednesday_entry').removeClass('hm-grid-form-select-error');
	$('#edit_wednesday_ending').removeClass('hm-grid-form-select-error');
	$('#edit_thursday_entry').removeClass('hm-grid-form-select-error');
	$('#edit_thursday_ending').removeClass('hm-grid-form-select-error');
	$('#edit_friday_entry').removeClass('hm-grid-form-select-error');
	$('#edit_friday_ending').removeClass('hm-grid-form-select-error');
	$('#edit_saturday_entry').removeClass('hm-grid-form-select-error');
	$('#edit_saturday_ending').removeClass('hm-grid-form-select-error');
	$('#edit_sunday_entry').removeClass('hm-grid-form-select-error');
	$('#edit_sunday_ending').removeClass('hm-grid-form-select-error');
	$('#edit_shift_name_message_error').addClass('d-none');
	$('#edit_monday_shift_message_error').addClass('d-none');
	$('#edit_tuesday_shift_message_error').addClass('d-none');
	$('#edit_wednesday_shift_message_error').addClass('d-none');
	$('#edit_thursday_shift_message_error').addClass('d-none');
	$('#edit_friday_shift_message_error').addClass('d-none');
	$('#edit_saturday_shift_message_error').addClass('d-none');
	$('#edit_sunday_shift_message_error').addClass('d-none');
};

function editar(registro) {
	form_edit.value = structuredClone(toRaw(registro));
};

function eliminar(registro) {
	form_delete.value = structuredClone(toRaw(registro));
};

const fadd = async () => {

	let name_validation, monday_validation, tuesday_validation, wednesday_validation, thursday_validation, friday_validation, saturday_validation, sunday_validation = false;

	if((form_add.monday_shift_entry != null && form_add.monday_shift_ending == null) || (form_add.monday_shift_ending != null && form_add.monday_shift_entry == null)) {
		$('#add_monday_entry').addClass('hm-grid-form-select-error');
		$('#add_monday_ending').addClass('hm-grid-form-select-error');
		$('#add_monday_shift_message_error').removeClass('d-none');
	}
	else {
		monday_validation = true;
	}

	if((form_add.tuesday_shift_entry != null && form_add.tuesday_shift_ending == null) || (form_add.tuesday_shift_ending != null && form_add.tuesday_shift_entry == null)) {
		$('#add_tuesday_entry').addClass('hm-grid-form-select-error');
		$('#add_tuesday_ending').addClass('hm-grid-form-select-error');
		$('#add_tuesday_shift_message_error').removeClass('d-none');
	}
	else {
		tuesday_validation = true;
	}

	if((form_add.wednesday_shift_entry != null && form_add.wednesday_shift_ending == null) || (form_add.wednesday_shift_ending != null && form_add.wednesday_shift_entry == null)) {
		$('#add_wednesday_entry').addClass('hm-grid-form-select-error');
		$('#add_wednesday_ending').addClass('hm-grid-form-select-error');
		$('#add_wednesday_shift_message_error').removeClass('d-none');
	}
	else {
		wednesday_validation = true;
	}

	if((form_add.thursday_shift_entry != null && form_add.thursday_shift_ending == null) || (form_add.thursday_shift_ending != null && form_add.thursday_shift_entry == null)) {
		$('#add_thursday_entry').addClass('hm-grid-form-select-error');
		$('#add_thursday_ending').addClass('hm-grid-form-select-error');
		$('#add_thursday_shift_message_error').removeClass('d-none');
	}
	else {
		thursday_validation = true;
	}

	if((form_add.friday_shift_entry != null && form_add.friday_shift_ending == null) || (form_add.friday_shift_ending != null && form_add.friday_shift_entry == null)) {
		$('#add_friday_entry').addClass('hm-grid-form-select-error');
		$('#add_friday_ending').addClass('hm-grid-form-select-error');
		$('#add_friday_shift_message_error').removeClass('d-none');
	}
	else {
		friday_validation = true;
	}

	if((form_add.saturday_shift_entry != null && form_add.saturday_shift_ending == null) || (form_add.saturday_shift_ending != null && form_add.saturday_shift_entry == null)) {
		$('#add_saturday_entry').addClass('hm-grid-form-select-error');
		$('#add_saturday_ending').addClass('hm-grid-form-select-error');
		$('#add_saturday_shift_message_error').removeClass('d-none');
	}
	else {
		saturday_validation = true;
	}

	if((form_add.sunday_shift_entry != null && form_add.sunday_shift_ending == null) || (form_add.sunday_shift_ending != null && form_add.sunday_shift_entry == null)) {
		$('#add_sunday_entry').addClass('hm-grid-form-select-error');
		$('#add_sunday_ending').addClass('hm-grid-form-select-error');
		$('#add_sunday_shift_message_error').removeClass('d-none');
	}
	else {
		sunday_validation = true;
	}

	if(form_add.name.length == 0 || form_add.name == null)  {
		$('#add_shift_name').addClass('hm-input-error');
		$('#add_shift_name_message_error').removeClass('d-none');
	}
	else {
		name_validation = true;
	}

	if(name_validation && monday_validation && tuesday_validation && wednesday_validation && thursday_validation && friday_validation && saturday_validation && sunday_validation) {

		try {
			let { data } = await axios.post(`/api/shifts`, form_add, headers);
			records.value.push(data);
			modal_add.hide();
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

	let name_validation, monday_validation, tuesday_validation, wednesday_validation, thursday_validation, friday_validation, saturday_validation, sunday_validation = false;

	if((form_edit.value.monday_shift_entry != null && form_edit.value.monday_shift_ending == null) || (form_edit.value.monday_shift_ending != null && form_edit.value.monday_shift_entry == null)) {
		$('#edit_monday_entry').addClass('hm-grid-form-select-error');
		$('#edit_monday_ending').addClass('hm-grid-form-select-error');
		$('#edit_monday_shift_message_error').removeClass('d-none');
	}
	else {
		monday_validation = true;
	}

	if((form_edit.value.tuesday_shift_entry != null && form_edit.value.tuesday_shift_ending == null) || (form_edit.value.tuesday_shift_ending != null && form_edit.value.tuesday_shift_entry == null)) {
		$('#edit_tuesday_entry').addClass('hm-grid-form-select-error');
		$('#edit_tuesday_ending').addClass('hm-grid-form-select-error');
		$('#edit_tuesday_shift_message_error').removeClass('d-none');
	}
	else {
		tuesday_validation = true;
	}

	if((form_edit.value.wednesday_shift_entry != null && form_edit.value.wednesday_shift_ending == null) || (form_edit.value.wednesday_shift_ending != null && form_edit.value.wednesday_shift_entry == null)) {
		$('#edit_wednesday_entry').addClass('hm-grid-form-select-error');
		$('#edit_wednesday_ending').addClass('hm-grid-form-select-error');
		$('#edit_wednesday_shift_message_error').removeClass('d-none');
	}
	else {
		wednesday_validation = true;
	}

	if((form_edit.value.thursday_shift_entry != null && form_edit.value.thursday_shift_ending == null) || (form_edit.value.thursday_shift_ending != null && form_edit.value.thursday_shift_entry == null)) {
		$('#edit_thursday_entry').addClass('hm-grid-form-select-error');
		$('#edit_thursday_ending').addClass('hm-grid-form-select-error');
		$('#edit_thursday_shift_message_error').removeClass('d-none');
	}
	else {
		thursday_validation = true;
	}

	if((form_edit.value.friday_shift_entry != null && form_edit.value.friday_shift_ending == null) || (form_edit.value.friday_shift_ending != null && form_edit.value.friday_shift_entry == null)) {
		$('#edit_friday_entry').addClass('hm-grid-form-select-error');
		$('#edit_friday_ending').addClass('hm-grid-form-select-error');
		$('#edit_friday_shift_message_error').removeClass('d-none');
	}
	else {
		friday_validation = true;
	}

	if((form_edit.value.saturday_shift_entry != null && form_edit.value.saturday_shift_ending == null) || (form_edit.value.saturday_shift_ending != null && form_edit.value.saturday_shift_entry == null)) {
		$('#edit_saturday_entry').addClass('hm-grid-form-select-error');
		$('#edit_saturday_ending').addClass('hm-grid-form-select-error');
		$('#edit_saturday_shift_message_error').removeClass('d-none');
	}
	else {
		saturday_validation = true;
	}

	if((form_edit.value.sunday_shift_entry != null && form_edit.value.sunday_shift_ending == null) || (form_edit.value.sunday_shift_ending != null && form_edit.value.sunday_shift_entry == null)) {
		$('#edit_sunday_entry').addClass('hm-grid-form-select-error');
		$('#edit_sunday_ending').addClass('hm-grid-form-select-error');
		$('#edit_sunday_shift_message_error').removeClass('d-none');
	}
	else {
		sunday_validation = true;
	}

	if(form_edit.value.name.length == 0 || form_edit.value.name == null) {
		$('#edit_shift_name').addClass('hm-input-error');
		$('#edit_shift_name_message_error').removeClass('d-none');
	}
	else {
		name_validation = true;
	}

	if(name_validation && monday_validation && tuesday_validation && wednesday_validation && thursday_validation && friday_validation && saturday_validation && sunday_validation) {
		try {
			let { data } = await axios.put(`/api/shifts`, form_edit.value, headers);
			for(var i = 0; i < records.value.length; i++) {
				if(records.value[i].id == data.id) {
					records.value[i] = data;
				}
			}
			modal_edit.hide();
		}
		catch(error) {
			erroresValidacion.value = error.response.data.errors;
			let options = {
				backdrop: true,
				focus: true,
				keyboard: true
			};

			let error_description = '';

			error_description += '<b class="hm-text-dark">Tipo:</b> HTTP<br>';
			error_description += '<b class="hm-text-dark">Código:</b> ' + error.response.status + ' ' + error.response.statusText + '<br>';
			error_description += '<b class="hm-text-dark">Descripción:</b> ' + error.response.data.message + '<br>';

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
		await axios.delete(`/api/shifts/${form_delete.value.id}`, headers);
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
	Object.assign(form_delete, getInitialForm());
};

</script>