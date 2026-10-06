<!-- Plantilla principal -->
@extends('layouts.app-layout')

<!-- Nombre de sección -->
@section('title', 'Dashboard')

<!-- Contenido de sección -->
@section('content')

	<!-- Header -->
	@include('components.header')

	<!-- Contenedor -->
	<div class="row m-0 p-0" style="height: calc(100% - 60px);">

		<!-- Menú de navegación -->
		@include('navigation.sidebar')

		<!--
			TODO
			Aquí se va a colocar el contenido del dashboard
		-->

	</div>

@endsection