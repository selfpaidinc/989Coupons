@extends('layouts.app')

@section('title', __('app.manage_coupons') )

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
			<div class="clearfix">
				<a href="{{ url('/staff/coupons/create') }}" class="btn btn-success pull-right" style="margin-bottom:10px;"><i class="fa fa-plus"></i> {{ __('app.create_coupon') }}</a>
			</div>
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('app.manage_coupons') }}</div>

				<table class="table table-hover">
					<thead>
						<tr>
							<th></th>
							<th>{{ __('app.id') }}</th>
							<th>{{ __('app.status') }}</th>
							<th>{{ __('app.title') }}</th>
							<th>{{ __('app.type') }}</th>
							<th>{{ __('app.code') }}</th>
							<th>{{ __('app.begins_on') }}</th>
							<th>{{ __('app.ends_on') }}</th>
						</tr>
					</thead>
					<tbody>
					@foreach( $coupons AS $coupon )
						<tr class="{{ ( Carbon\Carbon::parse( $coupon->barcode_ends )->timestamp < Carbon\Carbon::now()->timestamp ) ? 'bg-danger' : '' }}">
							<td>
								<a class="text-info" href="{{ url('/staff/coupons/edit/'.$coupon->id) }}" class=""><i class="fa fa-gear"></i></a> 
								@if( Auth::user()->role == 'admin' )
								<a href="{{ url('/staff/coupons/delete/'.$coupon->id) }}" onclick="return confirm('Are you sure you want to delete this coupon?');" class=""><i class="fa fa-trash"></i></a>	
								@endif
								<a class="text-warning" href="{{ url('/coupon/'.$coupon->id) }}" target="_blank"><i class="fa fa-eye"></i></a>
							</td>
							<td>{{ $coupon->id }}</td>
							<td><span class="label label-{{ $coupon->status == 'enabled' ? 'success' : 'danger' }}">{{ $coupon->status }}</span></td>
							<td>{{ $coupon->title }}</td>
							<td>{{ $coupon->barcode_type }}</td>
							<td>{{ $coupon->barcode_value }}</td>
							<td>{{ Carbon\Carbon::parse( $coupon->barcode_begins )->toFormattedDateString() }}</td>
							<td>{{ Carbon\Carbon::parse( $coupon->barcode_ends )->toFormattedDateString() }}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
            </div>
			
			{{ $coupons->links() }}
        </div>
    </div>
</div>
@endsection
