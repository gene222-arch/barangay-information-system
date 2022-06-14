<nav id="sidebar" class="sidebar-container">
    <div class="custom-menu">
      <button type="button" id="sidebarCollapse" class="btn btn-primary">
        <i class="fa fa-bars"></i>
        <span class="sr-only">Toggle Menu</span>
    </button>
  </div>
	<div class="p-3">
		<div class="row mb-5 mt-3 justify-content-center align-items-center">
			<div class="col-3">
				<img class="img img-responsive" src="{{ asset("logo.png") }}" width="40" height="40">
			</div>
			<div class="col">
				<h6><strong>{{ Auth::user()->name }}</strong></h6>
				<small>{{ Auth::user()->email }}</small>
			</div>
		</div>
      <ul class="list-unstyled components mb-5">
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
			<li class="{{ request()->is('assistance-requests') || request()->is('assistance-requests/*') ? 'active' : '' }}">
				<a href="/assistance-requests"><i class="fas fa-handshake-angle mr-3 {{ request()->is('assistance-requests') || request()->is('assistance-requests/*') ? 'text-info' : '' }}"></i>Assistance Requests</a>
			</li>
			@hasrole('Administrator|Supervisor')
				<li class="{{ request()->is('city-directory') || request()->is('city-directory') ? 'active' : '' }}">
					<a href="/city-directory"><i class="fa-solid fa-city mr-3 {{ request()->is('city-directory') || request()->is('city-directory/*') ? 'text-info' : '' }}"></i> City Directory</a>
				</li>
			@endhasrole
			<li>
				<a href="#" class="nav-link" onclick="document.getElementById('logout__form').submit()">
					<p><i class="fas fa-sign-out-alt mr-3 text-light"></i>Logout</p>
					<form action="{{ route('logout') }}" method="POST" id="logout__form">
						@csrf
					</form>
              	</a>
			</li>
      </ul>

      <div class="footer">
		<p>Copyright &copy;
			<script>document.write(new Date().getFullYear());</script> All rights reserved
		</p>
      </div>

  </div>
</nav>