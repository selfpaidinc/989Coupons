	<nav class="navbar navbar-default">
	  <div class="container">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">{{ __('app.menu_toggle') }}</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
			<a class="navbar-brand" href="{{ url('/') }}"><span class="text-danger">{{ env('APP_NAME') }}</span></a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <form class="navbar-form navbar-right">
			<a href="{{ url('/advertise') }}" class="btn btn-{{ env('THEME_ADVERTISE_BTN') }} btn-block"><i class="fa {{ env('THEME_ADVERTISE_ICON') }}"></i> {{ __('app.advertise') }}</a>
		  </form>
		  @if( Request::is('coupon/*') )
		  <form class="navbar-form navbar-right">
			<a href="{{ url('/') }}" class="btn btn-success }} btn-block"><i class="fa fa-envelope"></i> {{ __('app.send_coupons') }}</a>
		  </form>  
		  @endif
		  @if( Auth::user() )
		  <ul class="nav navbar-nav navbar-right">
			<li><a href="{{ url('/home') }}">{{ Auth::user()->role == 'admin' ? 'Admin' : 'Staff' }} Dash</a></li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->role == 'admin' ? 'Admin' : 'Staff' }} Menu <span class="caret"></span></a>
			  <ul class="dropdown-menu">
				@if( Auth::user()->role == 'admin' )
				<li><a href="{{ url('/admin/staff') }}">{{ __('app.menu_staff') }}</a></li>
				<li><a href="{{ url('/admin/subscribers') }}">{{ __('app.menu_subscribers') }}</a></li>
				@endif
				<li><a href="{{ url('/staff/coupons') }}">{{ __('app.menu_coupons') }}</a></li>
				<li><a href="{{ url('/staff/ads') }}">{{ __('app.menu_ads') }}</a></li>
				<li><a href="{{ url('/staff/emails') }}">{{ __('app.menu_emails') }}</a></li>
				<li role="separator" class="divider"></li>
				<li>
					<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('app.menu_logout') }}</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
				</li>
			  </ul>
			</li>
		  </ul>
		  @endif
		</div>
	  </div>
	</nav>