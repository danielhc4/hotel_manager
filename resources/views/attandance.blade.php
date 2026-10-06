<!-- Plantilla principal -->
@extends('layouts.app-layout')

<!-- Nombre de sección -->
@section('title', 'Departamentos')

<!-- Contenido de sección -->
@section('content')

	<!-- Header -->
	@include('components.header')

	<!-- Contenedor -->
	<div class="row m-0 p-0" style="height: calc(100% - 60px);">

		<!-- Menú de navegación -->
		@include('navigation.sidebar')

		<div class="col-10 h-100 p-5 main">
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
		</div>

	</div>

@endsection