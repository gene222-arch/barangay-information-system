<nav class="main-header navbar navbar-expand navbar-white text-white navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item d-none d-sm-inline-block">
			<a href="/" class="nav-link">
				Hi! {{ Auth::user()->name }} <strong>({{ (Auth::user()->roles->first()->name) }})</strong>
			</a>
		</li>
	</ul>
</nav>