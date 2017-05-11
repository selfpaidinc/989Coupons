@extends('layouts.app')

@section('title', __('app.manage_emails') )

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('app.manage_emails') }}</div>

				<table class="table table-hover">
					<thead>
						<tr>
							<th></th>
							<th>{{ __('app.id') }}</th>
							<th>{{ __('app.status') }}</th>
							<th>{{ __('app.sent') }}</th>
							<th>{{ __('app.list') }}</th>
							<th>{{ __('app.coupons') }}</th>
							<th>{{ __('app.ads') }}</th>
							<th>{{ __('app.send_date') }}</th>
							<th>{{ __('app.created_on') }}</th>
							<th>{{ __('app.last_update') }}</th>
						</tr>
					</thead>
					<tbody>
					@foreach( $emails AS $email )
						<tr class="{{ $email->sent == 1 ? 'bg-danger' : '' }}">
							<td><a class="text-info" href="{{ url('/staff/emails/edit/'.$email->id) }}" class=""><i class="fa fa-gear"></i></a></td>
							<td>{{ $email->id }}</td>
							<td><span class="label label-{{ $email->status == 'enabled' ? 'success' : 'danger' }}">{{ $email->status }}</span></td>
							<td>{{ $email->sent }}</td>
							<td>{{ $email->list == env('MAD_MIMI_MALES') ? __('app.males') : ( $email->list == env('MAD_MIMI_FEMALES') ? __('app.females') : ( $email->list == env('MAD_MIMI_FAMILIES') ? __('app.families') : '' ) ) }}</td>
							<td>{{ $email->coupons->count() }}</td>
							<td>{{ $email->ads->count() }}</td>
							<td>{{ Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse( $email->send_date ), false) < 0 ? ltrim(Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse( $email->send_date ), false),'-').' days ago' : 'in '.Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse( $email->send_date ), false).' days' }}</td>
							<td>{{ $email->created_at->toDayDateTimeString() }}</td>
							<td>{{ $email->updated_at->toDayDateTimeString() }}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
            </div>
			
			{{ $emails->links() }}
        </div>
    </div>
</div>
@endsection
