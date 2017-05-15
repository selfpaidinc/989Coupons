@extends('layouts.app')

@section('title', __('app.manage_staff') )

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
			<div class="clearfix">
				<a href="{{ url('/admin/staff/create') }}" class="btn btn-success pull-right" style="margin-bottom:10px;"><i class="fa fa-plus"></i> {{ __('app.create_staff') }}</a>
			</div>
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('app.manage_staff') }}</div>

				<table class="table table-hover">
					<thead>
						<tr>
							<th></th>
							<th>{{ __('app.role') }}</th>
							<th>{{ __('app.name') }}</th>
							<th>{{ __('app.email') }}</th>
							<th>{{ __('app.created_on') }}</th>
							<th>{{ __('app.last_update') }}</th>
						</tr>
					</thead>
					<tbody>
					@foreach( $staff AS $staff_ )
						<tr>
							<td>
								<a class="text-info" href="{{ url('/admin/staff/edit/'.$staff_->id) }}" class=""><i class="fa fa-gear"></i></a> 
								<a href="{{ url('/admin/staff/delete/'.$staff_->id) }}" onclick="return confirm('{{ __('app.are_you_sure_staff') }}');" class=""><i class="fa fa-trash"></i></a>
							</td>
							<td><span class="label label-{{ $staff_->role == 'admin' ? 'success' : 'danger' }}">{{ $staff_->role }}</span></td>
							<td>{{ $staff_->name }}</td>
							<td>{{ $staff_->email }}</td>
							<td>{{ $staff_->created_at->toDayDateTimeString() }}</td>
							<td>{{ $staff_->updated_at->toDayDateTimeString() }}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
            </div>
			
			{{ $staff->links() }}
        </div>
    </div>
</div>
@endsection
