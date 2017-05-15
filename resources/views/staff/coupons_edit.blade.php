@extends('layouts.app')

@section('title', __('app.edit_coupon') )

@push('scripts')
<script src="https://cdn.jsdelivr.net/jsbarcode/3.5.8/JsBarcode.all.min.js"></script>
<script>
$('#barcodeValue').on('input',function(e){
	updateBarcode();
});
$('#barcodeType').on('change',function(e){
	updateBarcode();
});
updateBarcode();
function updateBarcode()
{
	$("#barcode").JsBarcode($('#barcodeValue').val(), {
	  format: $('#barcodeType').val(),
	  background: "#ffffff",
	  lineColor: "#444444"
	});
}
</script>
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('app.edit_coupon') }}</div>

				<div class="panel-body">
				

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

				
					<form method="POST" class="opt-form">
						{{ csrf_field() }}
						<div class="form-group">
							<input type="text" name="id" class="form-control input-lg" value="{{ __('app.id') }}: {{ $coupon->id }}" readonly />
						</div>
						<div class="form-group">
							<select name="emails[]" class="form-control input-lg" multiple>
							@foreach( $choices['available'] AS $available )
								<option value="{{ $available['data']->id }}" {{ $available['selected'] ? 'selected' : '' }}>{{ __('app.id') }}: {{ $available['data']->id }} - {{ $available['data']->list == env('MAD_MIMI_MALES') ? __('app.males') : ( $available['data']->list == env('MAD_MIMI_FEMALES') ? __('app.females') : ( $available['data']->list == env('MAD_MIMI_FAMILIES') ? __('app.families') : '' ) ) }} - {{ Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse( $available['data']->send_date ), false) < 0 ? ltrim(Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse( $available['data']->send_date ), false),'-').' days ago' : 'in '.Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse( $available['data']->send_date ), false).' days' }}</option>
							@endforeach
							</select>
						</div>
						<div class="form-group">
							<select class="form-control input-lg" readonly multiple>
							@foreach( $choices['sent'] AS $sent )
								<option selected>{{ __('app.id') }}: {{ $sent->id }} - {{ $sent->list == env('MAD_MIMI_MALES') ? __('app.males') : ( $sent->list == env('MAD_MIMI_FEMALES') ? __('app.females') : ( $sent->list == env('MAD_MIMI_FAMILIES') ? __('app.families') : '' ) ) }} - {{ Carbon\Carbon::parse( $sent->send_date )->diffForHumans() }}</option>
							@endforeach
							</select>
						</div>
						@if( Auth::user()->role == 'admin' || env('APP_STAFF_COUPON_STATUS') != 'disabled' )
						<div class="form-group">
							<select name="status" class="form-control input-lg" required>
								<option value="">{{ __('app.status') }}</option>
								<option value="enabled" {{ $coupon->status == 'enabled' ? 'selected' : '' }}>{{ __('app.enabled') }}</option>
								<option value="disabled" {{ $coupon->status == 'disabled' ? 'selected' : '' }}>{{ __('app.disabled') }}</option>
							</select>
						</div>
						@endif
						<div class="form-group">
							<input type="text" name="title" class="form-control input-lg" value="{{ $coupon->title }}" placeholder="{{ __('app.title') }}" required />
						</div>
						<div class="form-group">
							<input type="date" name="barcode_begins" class="form-control input-lg" value="{{ $coupon->barcode_begins }}" placeholder="{{ __('app.start_date') }}" required />
						</div>
						<div class="form-group">
							<input type="date" name="barcode_ends" class="form-control input-lg" value="{{ $coupon->barcode_ends }}" placeholder="{{ __('app.end_date') }}" required />
						</div>
						<div class="form-group">
							<textarea name="description" rows="5" class="form-control input-lg" placeholder="{{ __('app.coupon_description') }}">{{ $coupon->description }}</textarea>
						</div>
						<div class="form-group">
							<textarea name="small_print" rows="5" class="form-control input-lg" placeholder="{{ __('app.coupon_small_print') }}">{{ $coupon->small_print }}</textarea>
						</div>
						<div class="form-group">
							<select class="form-control input-lg" name="barcode_type" id="barcodeType" title="CODE128" required>
								<option value="CODE128" {{ $coupon->barcode_type == 'CODE128' ? 'selected' : '' }}>{{ __('app.CODE128 auto') }}</option>
								<option value="CODE128A" {{ $coupon->barcode_type == 'CODE128A' ? 'selected' : '' }}>{{ __('app.CODE128 A') }}</option>
								<option value="CODE128B" {{ $coupon->barcode_type == 'CODE128B' ? 'selected' : '' }}>{{ __('app.CODE128 B') }}</option>
								<option value="CODE128C" {{ $coupon->barcode_type == 'CODE128C' ? 'selected' : '' }}>{{ __('app.CODE128 C') }}</option>
								<option value="EAN13" {{ $coupon->barcode_type == 'EAN13' ? 'selected' : '' }}>{{ __('app.EAN13') }}</option>
								<option value="EAN8" {{ $coupon->barcode_type == 'EAN8' ? 'selected' : '' }}>{{ __('app.EAN8') }}</option>
								<option value="UPC" {{ $coupon->barcode_type == 'UPC' ? 'selected' : '' }}>{{ __('app.UPC') }}</option>
								<option value="CODE39" {{ $coupon->barcode_type == 'CODE39' ? 'selected' : '' }}>{{ __('app.CODE39') }}</option>
								<option value="ITF14" {{ $coupon->barcode_type == 'ITF14' ? 'selected' : '' }}>{{ __('app.ITF14') }}</option>
								<option value="ITF" {{ $coupon->barcode_type == 'ITF' ? 'selected' : '' }}>{{ __('app.ITF') }}</option>
								<option value="MSI" {{ $coupon->barcode_type == 'MSI' ? 'selected' : '' }}>{{ __('app.MSI') }}</option>
								<option value="MSI10" {{ $coupon->barcode_type == 'MSI10' ? 'selected' : '' }}>{{ __('app.MSI10') }}</option>
								<option value="MSI11" {{ $coupon->barcode_type == 'MSI11' ? 'selected' : '' }}>{{ __('app.MSI11') }}</option>
								<option value="MSI1010" {{ $coupon->barcode_type == 'MSI1010' ? 'selected' : '' }}>{{ __('app.MSI1010') }}</option>
								<option value="MSI1110" {{ $coupon->barcode_type == 'MSI1110' ? 'selected' : '' }}>{{ __('app.MSI1110') }}</option>
								<option value="pharmacode" {{ $coupon->barcode_type == 'pharmacode' ? 'selected' : '' }}>{{ __('app.Pharmacode') }}</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" name="barcode_value" id="barcodeValue" class="form-control input-lg" value="{{ $coupon->barcode_value }}" placeholder="{{ __('app.barcode_value') }}" required />
						</div>
						<div class="form-group text-center">
							<svg id="barcode"></svg>
						</div>
						
						
						
						<button type="submit" style="margin-bottom:5px;" class="btn btn-{{ env('THEME_SUBSCRIBE_BTN') }} btn-block btn-lg">{{ __('app.update_coupon') }}</button>
						@if( Request::has('create') )
						<a href="{{ url('/staff/coupons/create') }}" class="btn btn-lg btn-block btn-warning">{{ __('app.create_another_coupon') }}</a>	
						@endif
						<a href="{{ url('/staff/coupons') }}" class="btn btn-lg btn-block btn-danger">{{ __('app.cancel_btn') }}</a>
					</form>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
