@extends('layouts.app')

@section('title', $coupon->title )

@push('scripts')
<script src="https://cdn.jsdelivr.net/jsbarcode/3.5.8/JsBarcode.all.min.js"></script>
<script>
 $("#barcode").JsBarcode("{{ $coupon->barcode_value }}", {
  format: "{{ $coupon->barcode_type }}",
  background: "#fcfcfc",
  lineColor: "#444444"
});
</script>
@endpush

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
				<h2 class="text-center lander">{{ $coupon->title }}</h2>
				<p class="text-center">{!! nl2br( $coupon->description ) !!}</p>
				<p class="text-center">{{ __('app.validity') }} {{ Carbon\Carbon::parse( $coupon->barcode_begins )->toFormattedDateString() }} - {{ Carbon\Carbon::parse( $coupon->barcode_ends )->toFormattedDateString() }}</p>
				<p class="text-center">{{ __('app.enter_code_at_checkout') }} <strong>{{ $coupon->barcode_value }}</strong></p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3 text-center">
				<svg id="barcode"></svg>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<p class="text-center"><small>{!! nl2br( $coupon->small_print ) !!}</small></p>
			</div>
		</div>
@endsection