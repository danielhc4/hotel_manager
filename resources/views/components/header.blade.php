<nav class="navbar navbar-expand-lg topbar" style="height: 60px;">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">{{ env('HM_TITLE') }}</a>
		<div class="sub d-flex">
            <div class="me-3" id="active_shifts"></div>
            <p class="m-0">{{ dateSpanish() }}</p>
        </div>
	</div>
</nav>