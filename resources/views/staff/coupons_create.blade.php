@extends('layouts.app')

@section('title', __('app.create_coupon') )

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
                <div class="panel-heading">{{ __('app.create_coupon') }}</div>

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
							<select name="emails[]" class="form-control input-lg" multiple>
							@foreach( $choices['available'] AS $email)
								<option value="{{ $email->id}}">{{ __('app.id') }}: {{ $email->id }} - {{ $email->list == env('MAD_MIMI_MALES') ? 'Males' : ( $email->list == env('MAD_MIMI_FEMALES') ? 'Females' : ( $email->list == env('MAD_MIMI_FAMILIES') ? 'Families' : '' ) ) }} - {{ Carbon\Carbon::parse( $email->send_date )->diffForHumans() }}</option>
							@endforeach
							</select>
						</div>
						@if( Auth::user()->role == 'admin' || env('APP_STAFF_COUPON_STATUS') != 'disabled' )
						<div class="form-group">
							<select name="status" class="form-control input-lg" required>
								<option value="">{{ __('app.status') }}</option>
								<option value="enabled">{{ __('app.enabled') }}</option>
								<option value="disabled">{{ __('app.disabled') }}</option>
							</select>
						</div>
						@endif
						<div class="form-group">
							<input type="text" name="title" class="form-control input-lg" value="" placeholder="{{ __('app.title') }}" required />
						</div>
						<div class="form-group">
							<input type="date" name="barcode_begins" class="form-control input-lg" value="" placeholder="{{ __('app.start_date') }}" required />
						</div>
						<div class="form-group">
							<input type="date" name="barcode_ends" class="form-control input-lg" value="" placeholder="{{ __('app.end_date') }}" required />
						</div>
						<div class="form-group">
							<textarea name="description" rows="5" class="form-control input-lg" placeholder="{{ __('app.coupon_description') }}"></textarea>
						</div>
						<div class="form-group">
							<textarea name="small_print" rows="5" class="form-control input-lg" placeholder="{{ __('app.coupon_small_print') }}"></textarea>
						</div>
						<div class="form-group">
							<select class="form-control input-lg" name="barcode_type" id="barcodeType" title="CODE128" required>
								<option value="CODE128">{{ __('app.CODE128 auto') }}</option>
								<option value="CODE128A">{{ __('app.CODE128 A') }}</option>
								<option value="CODE128B">{{ __('app.CODE128 B') }}</option>
								<option value="CODE128C">{{ __('app.CODE128 C') }}</option>
								<option value="EAN13">{{ __('app.EAN13') }}</option>
								<option value="EAN8">{{ __('app.EAN8') }}</option>
								<option value="UPC">{{ __('app.UPC') }}</option>
								<option value="CODE39">{{ __('app.CODE39') }}</option>
								<option value="ITF14">{{ __('app.ITF14') }}</option>
								<option value="ITF">{{ __('app.ITF') }}</option>
								<option value="MSI">{{ __('app.MSI') }}</option>
								<option value="MSI10">{{ __('app.MSI10') }}</option>
								<option value="MSI11">{{ __('app.MSI11') }}</option>
								<option value="MSI1010">{{ __('app.MSI1010') }}</option>
								<option value="MSI1110">{{ __('app.MSI1110') }}</option>
								<option value="pharmacode">{{ __('app.Pharmacode') }}</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" name="barcode_value" id="barcodeValue" class="form-control input-lg" value="" placeholder="{{ __('app.barcode_value') }}" required />
						</div>
						<div class="form-group text-center">
							<svg id="barcode"></svg>
						</div>
						
						<button type="submit" style="margin-bottom:5px;" class="btn btn-{{ env('THEME_SUBSCRIBE_BTN') }} btn-block btn-lg">{{ __('app.create_coupon') }}</button>
						<a href="{{ url('/staff/coupons') }}" class="btn btn-lg btn-block btn-danger">{{ __('app.cancel_btn') }}</a>
					</form>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
