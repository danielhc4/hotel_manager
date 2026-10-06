<!DOCTYPE html>
<html lang="en" class="w-100 h-100 p-0 m-0">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>Hotel Manager | {{ env('HM_TITLE') }} @yield('title', '')</title>
		<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
		<!-- Vite Directive -->
		@vite([
			'resources/sass/app.scss',
			'resources/js/app.js',
			'resources/js/calendar.js',
			'resources/js/bootstrap.js',
			'resources/js/vue.js',
			'resources/js/jquery.js',
		])
	</head>
	<body class="w-100 h-100 p-0 m-0">

		@yield('content')

		<div class="modal" id="modal-error" tabindex="-1">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Error en aplicación</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body p-5">
					<h5 id="modal-error-title"></h5>
					<p id="modal-error-description"></p>
					<div id="modal-error-code"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn hm-button-error-deep" data-bs-dismiss="modal">Cerrar</button>
				</div>
				</div>
			</div>
		</div>

	</body>
</html>