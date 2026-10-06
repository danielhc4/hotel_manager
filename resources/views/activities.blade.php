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

		<div class="col-10 h-100 p-5 main" id="app">
			<activities-component asset-url="{{ asset('images') }}"></activities-component>
		</div>

	</div>

@endsection