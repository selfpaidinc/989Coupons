@extends('layouts.app')

@section('title', 'Unsubscribe')

@section('content')
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h1 class="text-center">{!! __('app.unsubscribe_from', ['class' => 'danger', 'app' => env('APP_NAME')]) !!}</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<p class="text-center">{{ __('app.hate_to_see_you_go', ['app'=>env('APP_NAME')]) }}</p>
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
			<div class="col-md-6 col-md-offset-3 text-center">
				<form method="POST" class="opt-form">
					{{ csrf_field() }}
					<div class="form-group">
						<input type="email" name="email" class="form-control input-lg" value="" placeholder="{{ __('app.email_address') }}" />
					</div>
					<button type="submit" style="margin-bottom:5px;" class="btn btn-{{ env('THEME_UNSUBSCRIBE_BTN') }} btn-block btn-lg"><i class="fa fa-hand-o-right" aria-hidden="true"></i> {{ __('app.unsubscribe') }} <i class="fa fa-hand-o-left" aria-hidden="true"></i></button>
					<small>{{ __('app.by_submitting', ['app'=>env('APP_NAME')]) }}</small>
				</form>
			</div>
		</div>
@endsection