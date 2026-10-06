@extends('layouts.app-layout')

@section('title', 'Login')

@section('content')

<div class="row h-100">

	<!-- Left panel -->
	<div class="col-3 h-100 brand">
		<div class="brand-top">
			<span class="brand-eyebrow">Sistema de Gestión</span>
		</div>
		<div class="brand-center">
			<div class="brand-word">{{ env("HM_TITLE") }}</div>
			<div class="brand-sub" style="margin-top:0.6rem;">Sistema interno</div>
			<p class="brand-tagline">Sistema de gestión interno de personal, departamentos, horarios y permisos.</p>
		</div>
		<div class="brand-bottom">
			<div class="rule"></div>
			<span>Acceso exclusivo para personal autorizado</span>
		</div>
	</div>

	<!-- Login form -->
	<div class="col-9 h-100 form-side">
		<form method="POST" action="{{ route('login') }}" class="card" autocomplete="off">
			@csrf
			<div class="card-eyebrow">Bienvenido de nuevo</div>
			<h1>Iniciar sesión</h1>
			<p class="lead">Ingresa tus credenciales para entrar al panel de administración del hotel.</p>

			<div class="field">
				<label for="email">Usuario o correo electrónico</label>
				<div class="input-wrap">
					<input id="email" name="email" type="text" placeholder="nombre@losencinos.com" required>
				</div>
			</div>

			<div class="field">
				<label for="password">Contraseña</label>
				<div class="input-wrap">
					<input id="password" name="password" type="password" placeholder="••••••••" required>
				</div>
			</div>

			<div class="row-form">
				<label class="remember">
					<input type="checkbox" id="remember">
					Mantener sesión iniciada
				</label>
				<a href="#" class="forgot">¿Olvidaste tu contraseña?</a>
			</div>

			<button type="submit" class="btn">
				Entrar
			</button>

		</form>
	</div>
</div>

@endsection