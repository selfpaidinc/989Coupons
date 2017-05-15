		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h3 class="text-success text-center"><i class="fa fa-leaf fa-2x"></i><br />{{ __('app.go_green') }}</h3>
				<p class="footer text-center">
					<br />
					@if( env('APP_ADVERTISING_ENABLED') )
					<a href="{{ url('/advertise') }}">{{ __('app.advertise') }}</a> | 
					@endif
					<a href="{{ url('/contact') }}">{{ __('app.contact') }}</a> | 
					<a href="{{ url('/terms') }}">{{ __('app.terms') }}</a> | 
					<a href="{{ url('/privacy') }}">{{ __('app.privacy') }}</a> | 
					<a href="{{ url('/unsubscribe') }}">{{ __('app.unsubscribe') }}</a> | 
					<a href="https://github.com/selfpaidinc/989Coupons" target="_blank">{{ __('app.open_source') }}</a>
				</p>
			</div>
		</div>