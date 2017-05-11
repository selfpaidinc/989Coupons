@extends('layouts.app')

@section('title', 'Contact Us' )

@section('content')
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h1 class="text-center">{!! __('app.contact_header', ['app' => env('APP_NAME')]) !!}</h1>
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
			<div class="col-md-3 col-md-offset-3">
				<h4 class="text-center lander">{{ __('app.location') }}</h4>
				<p class="text-center">{{ env('APP_LOCATION_LINE_1') }}<br />{{ env('APP_LOCATION_LINE_2') }}</p>
			</div>
			<div class="col-md-3">
				<h4 class="text-center lander">{{ __('app.contact') }}</h4>
				<p class="text-center">{{ env('APP_CONTACT_PHONE') }}<br />{{ env('APP_CONTACT_EMAIL') }}</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h3 class="text-center lander">{{ __('app.contact_us') }}</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3 text-center">
				<form method="POST" action="{{ url('/contact') }}" class="opt-form">
					{{ csrf_field() }}
					<div class="form-group">
						<input type="text" name="name" class="form-control input-lg" value="" placeholder="{{ __('app.full_name') }}" required />
					</div>
					<div class="form-group">
						<input type="email" name="email" class="form-control input-lg" value="" placeholder="{{ __('app.email_address') }}" required />
					</div>
					<div class="form-group">
						<select name="subject" class="form-control input-lg" required>
							<option value="">{{ __('app.subject') }}</option>
							<option value="{{ __('app.question') }}">{{ __('app.question') }}</option>
							<option value="{{ __('app.suggestion') }}">{{ __('app.suggestion') }}</option>
							<option value="{{ __('app.advertising') }}" {{ Request::has('list') && Request::has('class') ? 'selected' : '' }}>{{ __('app.advertising') }}</option>
							<option value="{{ __('app.support') }}">{{ __('app.support') }}</option>
							<option value="{{ __('app.other') }}">{{ __('app.other') }}</option>
						</select>
					</div>
					<div class="form-group">
<textarea name="message" rows="5" class="form-control input-lg" placeholder="{{ __('app.message_placeholder') }}" required>
@if( Request::has('list') && Request::has('class') )
Hello,
I am interested in advertising on {{ env('APP_NAME') }}.

List: {{ Request::input('list') }}
Class: Class {{ Request::input('class') }}

Additional Notes:
@endif
</textarea>
					</div>
					<button type="submit" style="margin-bottom:5px;" class="btn btn-{{ env('THEME_SUBSCRIBE_BTN') }} btn-block btn-lg"><i class="fa fa-hand-o-right" aria-hidden="true"></i> {{ __('app.contact_btn',['app'=>env('APP_NAME')]) }} <i class="fa fa-hand-o-left" aria-hidden="true"></i></button>
					<small>{{ __('app.contact_small_print') }}</small>
				</form>
			</div>
		</div>
@endsection