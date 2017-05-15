@extends('layouts.app')

@section('title', __('app.create_subscriber') )

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('app.create_subscriber') }}</div>

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
							<select name="status" class="form-control input-lg" required>
								<option value="">{{ __('app.status') }}</option>
								<option value="active">{{ __('app.active') }}</option>
								<option value="disabled">{{ __('app.disabled') }}</option>
							</select>
						</div>
						<div class="form-group">
							<select name="list" class="form-control input-lg" required>
								<option value="">{{ __('app.list') }}</option>
								<option value="{{ env('MAD_MIMI_MALES') }}">{{ __('app.males') }}</option>
								<option value="{{ env('MAD_MIMI_FEMALES') }}">{{ __('app.females') }}</option>
								<option value="{{ env('MAD_MIMI_FAMILIES') }}">{{ __('app.families') }}</option>
							</select>
						</div>
						<div class="form-group">
							<input type="email" name="email" class="form-control input-lg" value="" placeholder="{{ __('app.email_address') }}" required />
						</div>
						<button type="submit" style="margin-bottom:5px;" class="btn btn-{{ env('THEME_SUBSCRIBE_BTN') }} btn-block btn-lg">{{ __('app.create_subscriber') }}</button>
						<a href="{{ url('/admin/subscribers') }}" class="btn btn-lg btn-block btn-danger">{{ __('app.cancel_btn') }}</a>
					</form>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
