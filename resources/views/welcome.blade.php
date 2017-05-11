@extends('layouts.app')

@section('title', env('APP_SLOGAN') )

@section('content')
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h1 class="text-center">{!! __('app.welcome', ['class' => 'danger', 'app' => env('APP_NAME')]) !!}</h1>
				@include('blocks.marquee')
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="flash-message">
				  @foreach (['danger', 'warning', 'success', 'info'] as $msg)
					@if(Session::has('alert-' . $msg))
					<p class="alert alert-{{ $msg }} noMarginBottom text-center">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>{{ Session::get('alert-' . $msg) }}</strong>
					</p>
					{{ Session::forget('alert-' . $msg) }}
					@endif
				  @endforeach
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h2 class="text-center lander">{{ __('app.subscribe_below') }}</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3 text-center">
				<form method="POST" action="{{ url('/') }}" class="opt-form">
					{{ csrf_field() }}
					<div class="form-group">
						<select name="type" class="form-control input-lg" required>
							<option value="">{{ __('app.i_am') }}</option>
							<option value="{{ env('MAD_MIMI_MALES') }}">{{ __('app.i_am_male') }}</option>
							<option value="{{ env('MAD_MIMI_FEMALES') }}">{{ __('app.i_am_female') }}</option>
							<option value="{{ env('MAD_MIMI_FAMILIES') }}">{{ __('app.i_am_family') }}</option>
						</select>
					</div>
					<div class="form-group">
						<input type="email" name="email" class="form-control input-lg" value="" placeholder="{{ __('app.email_address') }}" required />
					</div>
					<button type="submit" style="margin-bottom:5px;" class="btn btn-{{ env('THEME_SUBSCRIBE_BTN') }} btn-block btn-lg"><i class="fa fa-hand-o-right" aria-hidden="true"></i> {{ __('app.send_me_weekly_coupons') }} <i class="fa fa-hand-o-left" aria-hidden="true"></i></button>
					<small>{{ __('app.by_subscribing') }}</small>
				</form>
			</div>
		</div>
@endsection