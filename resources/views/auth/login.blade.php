@extends('layouts.app')

@section('title', __('app.login_h4') )

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h1 class="text-center"><span class="text-danger">{{ env('APP_NAME') }}</span></h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h4 class="text-center lander">{{ __('app.login_h4') }}</h4>
		</div>
	</div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
			<form class="form-horizontal login" role="form" method="POST" action="{{ route('login') }}">
				{{ csrf_field() }}

				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<div class="col-md-12">
						<div class="input-group">
							<div class="input-group-addon app-addon"><i class="fa fa-envelope fa-2x fa-fw"></i></div>
							<input id="email" type="email" class="form-control input-lg" name="email" placeholder="{{ __('app.email_address') }}" value="{{ old('email') }}" required autofocus>
						</div>
						@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<div class="col-md-12">
						<div class="input-group">
							<div class="input-group-addon app-addon"><i class="fa fa-lock fa-2x fa-fw"></i></div>
							<input id="password" type="password" class="form-control input-lg" placeholder="{{ __('app.password') }}" name="password" required>
						</div>
						@if ($errors->has('password'))
							<span class="help-block">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-12">
						<div class="input-group">
							<span class="input-group-addon beautiful app-addon">
								<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
							</span>
							<input type="text" class="form-control input-lg bg-white" readonly>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-12">
						<button type="submit" class="btn btn-success btn-block btn-lg">
							{{ __('app.login_btn') }}
						</button>

						<a class="btn btn-link btn-block" href="{{ route('password.request') }}">
							{{ __('app.forgot_pass') }}
						</a>
					</div>
				</div>
			</form>
        </div>
    </div>
	<script>var lang_remember = '@lang('app.remember')', lang_do_not_remember = '@lang('app.do_not_remember')';</script>
@endsection
