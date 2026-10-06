<template>

    <div class="row h-100">
        <div class="col-12 h-100">
            <div class="card rounded-4 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
						<div>
							<h5 class="card-title">Horarios</h5>
							<!-- <p class="card-text">Horarios de personal</p> -->
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
                            <tr v-for="registro in registros" :key="registro.id">

                                <!-- Name -->
								<td><span class="hm-table-text-dark-bold">{{ registro.name }}</span></td>
								
                                <!-- Monday -->
                                <td v-if="registro.monday_shift_entry">
                                    <span class="badge rounded-pill hm-table-badge hm-table-badge-color-oak-soft">{{ registro.monday_shift_entry }}</span>
                                    <span class="badge rounded-pill hm-table-badge hm-table-badge-color-coral">{{ registro.monday_shift_ending }}</span>
                                </td>
                                <td v-else>
                                    <span class="badge rounded-pill hm-table-badge hm-table-badge-color-gold">Descanso</span>
                                </td>

                                <!-- Tuesday -->
                                <td v-if="registro.tuesday_shift_entry">
                                    <span class="badge rounded-pill hm-table-badge hm-table-badge-color-oak-soft">{{ registro.tuesday_shift_entry }}</span>
                                    <span class="badge rounded-pill hm-table-badge hm-table-badge-color-coral">{{ registro.tuesday_shift_ending }}</span>
                                </td>
                                <td v-else>
                                    <span class="badge rounded-pill hm-table-badge hm-table-badge-color-gold">Descanso</span>
                                </td>

                                <!-- Wednesday -->
                                <td v-if="registro.wednesday_shift_entry">
                                    <span class="badge rounded-pill hm-table-badge hm-table-badge-color-oak-soft">{{ registro.wednesday_shift_entry }}</span>
                                    <span class="badge rounded-pill hm-table-badge hm-table-badge-color-coral">{{ registro.wednesday_shift_ending }}</span>
                                </td>
                                <td v-else>
                                    <span class="badge rounded-pill hm-table-badge hm-table-badge-color-gold">Descanso</span>
                                </td>

                                <!-- Thursday -->
                                <td v-if="registro.thursday_shift_entry">
                                    <span class="badge rounded-pill hm-table-badge hm-table-badge-color-oak-soft">{{ registro.thursday_shift_entry }}</span>
                                    <span class="badge rounded-pill hm-table-badge hm-table-badge-color-coral">{{ registro.thursday_shift_ending }}</span>
                                </td>
                                <td v-else>
                                    <span class="badge rounded-pill hm-table-badge hm-table-badge-color-gold">Descanso</span>
                                </td>

                                <!-- Friday -->
                                <td v-if="registro.friday_shift_entry">
                                    <span class="badge rounded-pill hm-table-badge hm-table-badge-color-oak-soft">{{ registro.friday_shift_entry }}</span>
                                    <span class="badge rounded-pill hm-table-badge hm-table-badge-color-coral">{{ registro.friday_shift_ending }}</span>
                                </td>
                                <td v-else>
                                    <span class="badge rounded-pill hm-table-badge hm-table-badge-color-gold">Descanso</span>
                                </td>

                                <!-- Saturday -->
                                <td v-if="registro.saturday_shift_entry">
                                    <span class="badge rounded-pill hm-table-badge hm-table-badge-color-oak-soft">{{ registro.saturday_shift_entry }}</span>
                                    <span class="badge rounded-pill hm-table-badge hm-table-badge-color-coral">{{ registro.saturday_shift_ending }}</span>
                                </td>
                                <td v-else>
                                    <span class="badge rounded-pill hm-table-badge hm-table-badge-color-gold">Descanso</span>
                                </td>

                                <!-- Sunday -->
                                <td v-if="registro.sunday_shift_entry">
                                    <span class="badge rounded-pill hm-table-badge hm-table-badge-color-oak-soft">{{ registro.sunday_shift_entry }}</span>
                                    <span class="badge rounded-pill hm-table-badge hm-table-badge-color-coral">{{ registro.sunday_shift_ending }}</span>
                                </td>
                                <td v-else>
                                    <span class="badge rounded-pill hm-table-badge hm-table-badge-color-gold">Descanso</span>
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
				<form @submit.prevent="save_add" class="hm-grid-form">
					<div class="modal-header">
						<h1 class="modal-title fs-5">Agregar turno</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clear_form()"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label for="add_shift_name" class="form-label">Nombre de turno</label>
							<input type="text" id="add_shift_name" class="form-control hm-input" placeholder="Ej. Turno matutino" v-model="form_add.name">
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
                                        <select class="form-select" id="monday_entry" v-model="form_add.monday_shift_entry">
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
                                        <select class="form-select" id="monday_ending" v-model="form_add.monday_shift_ending">
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
                                    <div id="monday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día lunes. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
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
                                        <select class="form-select" id="tuesday_entry" v-model="form_add.tuesday_shift_entry">
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
                                        <select class="form-select" id="tuesday_ending" v-model="form_add.tuesday_shift_ending">
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
                                    <div id="tuesday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día martes. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
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
                                        <select class="form-select" id="wednesday_entry" v-model="form_add.wednesday_shift_entry">
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
                                        <select class="form-select" id="wednesday_ending" v-model="form_add.wednesday_shift_ending">
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
                                    <div id="wednesday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día miércoles. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
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
                                        <select class="form-select" id="thursday_entry" v-model="form_add.thursday_shift_entry">
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
                                        <select class="form-select" id="thursday_ending" v-model="form_add.thursday_shift_ending">
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
                                    <div id="thursday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día jueves. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
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
                                        <select class="form-select" id="friday_entry" v-model="form_add.friday_shift_entry">
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
                                        <select class="form-select" id="friday_ending" v-model="form_add.friday_shift_ending">
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
                                    <div id="friday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día viernes. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
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
                                        <select class="form-select" id="saturday_entry" v-model="form_add.saturday_shift_entry">
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
                                        <select class="form-select" id="saturday_ending" v-model="form_add.saturday_shift_ending">
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
                                    <div id="saturday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día sábado. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
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
                                        <select class="form-select" id="sunday_entry" v-model="form_add.sunday_shift_entry">
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
                                        <select class="form-select" id="sunday_ending" v-model="form_add.sunday_shift_ending">
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
                                    <div id="sunday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día domingo. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
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
				<form @submit.prevent="save_edit" class="hm-grid-form">
					<div class="modal-header">
						<h1 class="modal-title fs-5">Editar turno</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clear_form()"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label for="edit_shift_name" class="form-label">Nombre de turno</label>
							<input type="text" id="edit_shift_name" class="form-control hm-input" placeholder="Ej. Turno matutino" v-model="form_edit.name">
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
                                        <select class="form-select" id="monday_entry" v-model="form_edit.monday_shift_entry">
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
                                        <select class="form-select" id="monday_ending" v-model="form_edit.monday_shift_ending">
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
                                    <div id="monday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día lunes. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
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
                                        <select class="form-select" id="tuesday_entry" v-model="form_edit.tuesday_shift_entry">
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
                                        <select class="form-select" id="tuesday_ending" v-model="form_edit.tuesday_shift_ending">
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
                                    <div id="tuesday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día martes. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
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
                                        <select class="form-select" id="wednesday_entry" v-model="form_edit.wednesday_shift_entry">
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
                                        <select class="form-select" id="wednesday_ending" v-model="form_edit.wednesday_shift_ending">
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
                                    <div id="wednesday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día miércoles. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
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
                                        <select class="form-select" id="thursday_entry" v-model="form_edit.thursday_shift_entry">
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
                                        <select class="form-select" id="thursday_ending" v-model="form_edit.thursday_shift_ending">
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
                                    <div id="thursday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día jueves. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
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
                                        <select class="form-select" id="friday_entry" v-model="form_edit.friday_shift_entry">
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
                                        <select class="form-select" id="friday_ending" v-model="form_edit.friday_shift_ending">
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
                                    <div id="friday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día viernes. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
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
                                        <select class="form-select" id="saturday_entry" v-model="form_edit.saturday_shift_entry">
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
                                        <select class="form-select" id="saturday_ending" v-model="form_edit.saturday_shift_ending">
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
                                    <div id="saturday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día sábado. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
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
                                        <select class="form-select" id="sunday_entry" v-model="form_edit.sunday_shift_entry">
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
                                        <select class="form-select" id="sunday_ending" v-model="form_edit.sunday_shift_ending">
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
                                    <div id="sunday_shift_message_error" class="form-text d-none">Inconsistencia al guardar horario de día domingo. Si se elige descanso en una de las casillas, se debe elegir descanso en la otra.</div>
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

const registros = ref([]);
const form_edit = ref({});
const form_delete = ref({});
const erroresValidacion = ref({});

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

const form_add = reactive(getInitialForm())

const headers = {
	'Accept': 'application/json'
};

onMounted(async () => {
	load_records();
});

async function load_records () {
    const { data } = await axios.get('/api/shifts', headers);
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

const save_add = async () => {
    try {
		await axios.post(`/api/shifts`, form_add, headers);
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

    let monday_validation, tuesday_validation, wednesday_validation, thursday_validation, friday_validation, saturday_validation, sunday_validation = false;

    $('#monday_entry').removeClass('hm-grid-form-select-error');
    $('#monday_ending').removeClass('hm-grid-form-select-error');
    $('#tuesday_entry').removeClass('hm-grid-form-select-error');
    $('#tuesday_ending').removeClass('hm-grid-form-select-error');
    $('#wednesday_entry').removeClass('hm-grid-form-select-error');
    $('#wednesday_ending').removeClass('hm-grid-form-select-error');
    $('#thursday_entry').removeClass('hm-grid-form-select-error');
    $('#thursday_ending').removeClass('hm-grid-form-select-error');
    $('#friday_entry').removeClass('hm-grid-form-select-error');
    $('#friday_ending').removeClass('hm-grid-form-select-error');
    $('#saturday_entry').removeClass('hm-grid-form-select-error');
    $('#saturday_ending').removeClass('hm-grid-form-select-error');
    $('#sunday_entry').removeClass('hm-grid-form-select-error');
    $('#sunday_ending').removeClass('hm-grid-form-select-error');

    $('#monday_shift_message_error').addClass('d-none');
    $('#tuesday_shift_message_error').addClass('d-none');
    $('#wednesday_shift_message_error').addClass('d-none');
    $('#thursday_shift_message_error').addClass('d-none');
    $('#friday_shift_message_error').addClass('d-none');
    $('#saturday_shift_message_error').addClass('d-none');
    $('#sunday_shift_message_error').addClass('d-none');

    if((form_edit.value.monday_shift_entry != null && form_edit.value.monday_shift_ending == null) || (form_edit.value.monday_shift_ending != null && form_edit.value.monday_shift_entry == null)) {
        $('#monday_entry').addClass('hm-grid-form-select-error');
        $('#monday_ending').addClass('hm-grid-form-select-error');
        $('#monday_shift_message_error').removeClass('d-none');
    }
    else {
        monday_validation = true;
    }

    if((form_edit.value.tuesday_shift_entry != null && form_edit.value.tuesday_shift_ending == null) || (form_edit.value.tuesday_shift_ending != null && form_edit.value.tuesday_shift_entry == null)) {
        $('#tuesday_entry').addClass('hm-grid-form-select-error');
        $('#tuesday_ending').addClass('hm-grid-form-select-error');
        $('#tuesday_shift_message_error').removeClass('d-none');
    }
    else {
        tuesday_validation = true;
    }

    if((form_edit.value.wednesday_shift_entry != null && form_edit.value.wednesday_shift_ending == null) || (form_edit.value.wednesday_shift_ending != null && form_edit.value.wednesday_shift_entry == null)) {
        $('#wednesday_entry').addClass('hm-grid-form-select-error');
        $('#wednesday_ending').addClass('hm-grid-form-select-error');
        $('#wednesday_shift_message_error').removeClass('d-none');
    }
    else {
        wednesday_validation = true;
    }

    if((form_edit.value.thursday_shift_entry != null && form_edit.value.thursday_shift_ending == null) || (form_edit.value.thursday_shift_ending != null && form_edit.value.thursday_shift_entry == null)) {
        $('#thursday_entry').addClass('hm-grid-form-select-error');
        $('#thursday_ending').addClass('hm-grid-form-select-error');
        $('#thursday_shift_message_error').removeClass('d-none');
    }
    else {
        thursday_validation = true;
    }

    if((form_edit.value.friday_shift_entry != null && form_edit.value.friday_shift_ending == null) || (form_edit.value.friday_shift_ending != null && form_edit.value.friday_shift_entry == null)) {
        $('#friday_entry').addClass('hm-grid-form-select-error');
        $('#friday_ending').addClass('hm-grid-form-select-error');
        $('#friday_shift_message_error').removeClass('d-none');
    }
    else {
        friday_validation = true;
    }

    if((form_edit.value.saturday_shift_entry != null && form_edit.value.saturday_shift_ending == null) || (form_edit.value.saturday_shift_ending != null && form_edit.value.saturday_shift_entry == null)) {
        $('#saturday_entry').addClass('hm-grid-form-select-error');
        $('#saturday_ending').addClass('hm-grid-form-select-error');
        $('#saturday_shift_message_error').removeClass('d-none');
    }
    else {
        saturday_validation = true;
    }

    if((form_edit.value.sunday_shift_entry != null && form_edit.value.sunday_shift_ending == null) || (form_edit.value.sunday_shift_ending != null && form_edit.value.sunday_shift_entry == null)) {
        $('#sunday_entry').addClass('hm-grid-form-select-error');
        $('#sunday_ending').addClass('hm-grid-form-select-error');
        $('#sunday_shift_message_error').removeClass('d-none');
    }
    else {
        sunday_validation = true;
    }


    if(monday_validation && tuesday_validation && wednesday_validation && thursday_validation && friday_validation && saturday_validation && sunday_validation) {
        try {
            await axios.put(`/api/shifts`, form_edit.value, headers);
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

                    error_description += '<b class="hm-text-dark">Tipo:</b> HTTP<br>';
                    error_description += '<b class="hm-text-dark">Código:</b> ' + error.response.status + ' ' + error.response.statusText + '<br>';
                    error_description += '<b class="hm-text-dark">Descripción:</b> ' + error.response.data.message + '<br>';

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
        bootstrap.Modal.getInstance($('#edit-modal')[0]).hide();
    }
    Object.assign(form_edit, getInitialForm());
};

const save_delete = async () => {
	try {
		await axios.delete(`/api/shifts/${form_delete.value.id}`, headers);
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