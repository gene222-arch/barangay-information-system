<nav id="sidebar" class="sidebar-container">
    <div class="custom-menu">
      <button type="button" id="sidebarCollapse" class="btn btn-primary">
        <i class="fa fa-bars"></i>
        <span class="sr-only">Toggle Menu</span>
    </button>
  </div>
	<div class="p-3 mt-5 pt-5">
      <ul class="list-unstyled components">
		<li class="{{ request()->is('/') ? 'active' : '' }}">
			<a href="/"><span class="fa fa-home mr-3 {{ request()->is('/') ? 'text-info' : '' }}"></span> Dashboard</a>
		</li>
		@hasrole('Administrator|Supervisor')
			<li class="{{ request()->is('residents') || request()->is('residents/*') ? 'active' : '' }}">
				<a href="/residents"><i class="fas fa-user mr-3 {{ request()->is('residents') || request()->is('residents/*') ? 'text-info' : '' }}"></i> Residents</a>
			</li>
			<li class="{{ request()->is('non-residents') || request()->is('non-residents/*') ? 'active' : '' }}">
				<a href="/non-residents"><i class="fas fa-user mr-3 {{ request()->is('non-residents') || request()->is('non-residents/*') ? 'text-info' : '' }}"></i>Non Residents</a>
			</li>
			<li class="{{ request()->is('documents') || request()->is('documents/*') ? 'active' : '' }}">
				<a href="/documents"><i class="fas fa-file-arrow-down mr-3 {{ request()->is('documents') || request()->is('documents/*') ? 'text-info' : '' }}"></i>Documents</a>
			</li>
		@endhasrole
		@hasrole('Administrator|Supervisor')
			<li class="{{ request()->is('notes') || request()->is('notes/*') ? 'active' : '' }}">
				<a href="/notes"><i class="fa-solid fa-note-sticky mr-3 {{ request()->is('notes') || request()->is('notes/*') ? 'text-info' : '' }}"></i> Notes</a>
			</li>
		@endhasrole
		@hasrole('Administrator|Supervisor')
			<li class="{{ request()->is('schedules') || request()->is('schedules/*') ? 'active' : '' }}">
				<a href="/schedules"><i class="fas fa-calendar mr-3 {{ request()->is('schedules') || request()->is('schedules/*') ? 'text-info' : '' }}"></i> Schedules</a>
			</li>
		@endhasrole
		<li class="{{ request()->is('reservations') || request()->is('reservations/*') ? 'active' : '' }}">
			<a href="/reservations"><i class="fas fa-basketball mr-3 {{ request()->is('reservations') || request()->is('reservations/*') ? 'text-info' : '' }}"></i>Court Reservations</a>
		</li>
		<li class="{{ request()->is('city-directory') || request()->is('city-directory') ? 'active' : '' }}">
			<a href="/city-directory"><i class="fa-solid fa-city mr-3 {{ request()->is('city-directory') || request()->is('city-directory/*') ? 'text-info' : '' }}"></i> City Directory</a>
		</li>
		<li>
			<a href="#" class="nav-link" onclick="document.getElementById('logout__form').submit()">
				<p><i class="fas fa-sign-out-alt mr-3 text-light"></i>Logout</p>
				<form action="{{ route('logout') }}" method="POST" id="logout__form">
					@csrf
				</form>
			</a>
		</li>
      </ul>
  </div>
</nav>