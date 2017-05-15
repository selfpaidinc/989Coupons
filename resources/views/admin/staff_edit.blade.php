@extends('layouts.app')

@section('title', __('app.edit_staff_member') )

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('app.edit_staff') }}</div>

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
							<input type="text" name="id" class="form-control input-lg" value="{{ __('app.id') }}: {{ $staff->id }}" readonly />
						</div>
						<div class="form-group">
							<select name="role" class="form-control input-lg" required>
								<option value="">{{ __('app.role') }}</option>
								<option value="admin" {{ $staff->role == 'admin' ? 'selected' : '' }}>{{ __('app.admin') }}</option>
								<option value="staff" {{ $staff->role == 'staff' ? 'selected' : '' }}>{{ __('app.staff') }}</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" name="name" class="form-control input-lg" value="{{ $staff->name }}" placeholder="{{ __('app.full_name') }}" required />
						</div>
						<div class="form-group">
							<input type="email" name="email" class="form-control input-lg" value="{{ $staff->email }}" placeholder="{{ __('app.email_address') }}" required />
						</div>
						<div class="form-group">
							<input type="text" name="password" class="form-control input-lg" value="" placeholder="{{ __('app.password') }}" />
						</div>
						<button type="submit" style="margin-bottom:5px;" class="btn btn-{{ env('THEME_SUBSCRIBE_BTN') }} btn-block btn-lg">{{ __('app.update_staff') }}</button>
						@if( Request::has('create') )
						<a href="{{ url('/admin/staff/create') }}" class="btn btn-lg btn-block btn-warning">{{ __('app.create_another_staff') }}</a>	
						@endif
						<a href="{{ url('/admin/staff') }}" class="btn btn-lg btn-block btn-danger">{{ __('app.cancel_btn') }}</a>
					</form>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
