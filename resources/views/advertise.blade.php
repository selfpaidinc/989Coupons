@extends('layouts.app')

@section('title', __('app.advertise_on_title', ['app' => env('APP_NAME')]) )

@section('content')
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h1 class="text-center">{!! __('app.advertise_on', ['class' => 'danger', 'app' => env('APP_NAME')]) !!}</h1>
				@include('blocks.marquee')
			</div>
		</div>
		@if( env('APP_ADVERTISING_ENABLED') )
			@include('advertising.enabled')
		@else
			@include('advertising.disabled')
		@endif
@endsection