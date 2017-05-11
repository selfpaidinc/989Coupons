@extends('layouts.app')

@section('title', __('app.edit_email') )

@push('scripts')
<script>
    function popitup(url) {
        newwindow=window.open(url,'name','height=600,width=600');
        if (window.focus) {newwindow.focus()}
        return false;
    }
</script>
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('app.edit_email') }}</div>

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
							<input type="text" name="id" class="form-control input-lg" value="{{ __('app.id') }}: {{ $email->id }}" readonly />
						</div>
						@if( Auth::user()->role == 'admin' || env('APP_STAFF_EMAIL_STATUS') != 'disabled' )
							<div class="form-group">
								<select name="status" class="form-control input-lg" required>
									<option value="">{{ __('app.status') }}</option>
									<option value="enabled" {{ $email->status == 'enabled' ? 'selected' : '' }}>{{ __('app.enabled') }}</option>
									<option value="disabled" {{ $email->status == 'disabled' ? 'selected' : '' }}>{{ __('app.disabled') }}</option>
								</select>
							</div>
						@endif
						<div class="form-group">
							<input type="text" name="list" class="form-control input-lg" value="{{ __('app.list') }}: {{ $email->list == env('MAD_MIMI_MALES') ? __('app.males') : ( $email->list == env('MAD_MIMI_FEMALES') ? __('app.females') : ( $email->list == env('MAD_MIMI_FAMILIES') ? __('app.families') : '' ) ) }}" readonly />
						</div>
						<div class="form-group">
							<input type="text" name="send_date" class="form-control input-lg" value="{{ __('app.send_date') }}: {{ Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse( $email->send_date ), false) < 0 ? ltrim(Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse( $email->send_date ), false),'-').' days ago' : 'in '.Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse( $email->send_date ), false).' days' }}" readonly />
						</div>
						<div class="form-group">
							<input type="text" name="subject_line" class="form-control input-lg" placeholder="{{ __('app.subject_line') }}" value="{{ $email->subject_line }}" />
						</div>
						<div class="form-group">
							<select name="coupons[]" class="form-control input-lg" multiple>
								@foreach( $coupons AS $coupon )
									<option value="{{ $coupon['data']->id }}" {{ $coupon['selected'] ? 'selected' : '' }}>{{ $coupon['data']->title }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<select name="ads[]" class="form-control input-lg" multiple>
								@foreach( $ads AS $ad )
									<option value="{{ $ad['data']->id }}" {{ $ad['selected'] ? 'selected' : '' }}>{{ $ad['data']->title }} - Class {{ strtoupper( $ad['data']->class ) }}</option>
								@endforeach
							</select>
						</div>
						<button type="submit" style="margin-bottom:5px;" class="btn btn-{{ env('THEME_SUBSCRIBE_BTN') }} btn-block btn-lg">{{ __('app.update_email') }}</button>
						<a href="{{ url('/staff/emails/preview/'.$email->id) }}" class="btn btn-default btn-block btn-lg" onclick="return popitup('{{ url('/staff/emails/preview/'.$email->id) }}')">{{ __('app.preview_email') }}</a>
						<a href="{{ url('/staff/emails') }}" class="btn btn-lg btn-block btn-danger">{{ __('app.cancel_btn') }}</a>
					</form>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
