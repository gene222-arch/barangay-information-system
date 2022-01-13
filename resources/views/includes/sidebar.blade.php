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
				<img class="img img-responsive" src="{{ asset("storage/app/logo.png") }}" width="40" height="40">
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
			@hasrole('Administrator')
				<li class="{{ request()->is('scanner') || request()->is('scanner/*') ? 'active' : '' }}">
					<a href="/scanner"><i class="fas fa-qrcode text-light mr-3 {{ request()->is('scanner') || request()->is('scanner/*') ? 'text-info' : '' }}"></i> Barcode Scanner</a>
				</li>
			@endhasrole
			@hasrole('Administrator')
				<li class="{{ request()->is('residents') || request()->is('residents/*') ? 'active' : '' }}">
					<a href="/residents"><i class="fas fa-user mr-3 {{ request()->is('residents') || request()->is('residents/*') ? 'text-info' : '' }}"></i> Residents</a>
				</li>
			@endhasrole
			@hasrole('Administrator')
				<li class="{{ request()->is('schedules') || request()->is('schedules/*') ? 'active' : '' }}">
					<a href="/schedules"><i class="fas fa-calendar mr-3 {{ request()->is('schedules') || request()->is('schedules/*') ? 'text-info' : '' }}"></i> Schedules</a>
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