@extends('layouts.app')

@section('title', __('app.manage_subscribers') )

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
			<div class="clearfix">
				<a href="{{ url('/admin/subscribers/create') }}" class="btn btn-success pull-right" style="margin-bottom:10px;"><i class="fa fa-plus"></i> {{ __('app.create_subscriber') }}</a>
			</div>
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('app.manage_subscribers') }}</div>

				<table class="table table-hover">
					<thead>
						<tr>
							<th></th>
							<th>{{ __('app.id') }}</th>
							<th>{{ __('app.status') }}</th>
							<th>{{ __('app.list') }}</th>
							<th>{{ __('app.email') }}</th>
							<th>{{ __('app.created_on') }}</th>
							<th>{{ __('app.last_update') }}</th>
						</tr>
					</thead>
					<tbody>
					@foreach( $subscribers AS $subscriber )
						<tr>
							<td><a class="text-info" href="{{ url('/admin/subscribers/edit/'.$subscriber->id) }}" class=""><i class="fa fa-gear"></i></a></td>
							<td>{{ $subscriber->id }}</td>
							<td><span class="label label-{{ $subscriber->status == 'active' ? 'success' : 'danger' }}">{{ $subscriber->status }}</span></td>
							<td>{{ $subscriber->list == env('MAD_MIMI_MALES') ? 'Males' : ( $subscriber->list == env('MAD_MIMI_FEMALES') ? 'Females' : ( $subscriber->list == env('MAD_MIMI_FAMILIES') ? 'Families' : '' ) ) }}</td>
							<td>{{ $subscriber->email }}</td>
							<td>{{ $subscriber->created_at->toDayDateTimeString() }}</td>
							<td>{{ $subscriber->updated_at->toDayDateTimeString() }}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
            </div>
			
			{{ $subscribers->links() }}
        </div>
    </div>
</div>
@endsection
