<nav class="main-header navbar navbar-expand navbar-white text-white navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item d-none d-sm-inline-block">
			<a href="/" class="nav-link">
				Hi! <strong>{{ Auth::user()->name }}</strong>
			</a>
		</li>
	</ul>
</nav>