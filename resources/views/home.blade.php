@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ Auth::user()->role == 'admin' ? 'Admin' : 'Staff' }} Dashboard</div>

                <div class="panel-body">
                    <ul style="no-style">
						<li>Each subscriber is worth ${{ env('APP_PER_SUBSCRIBER') }} per email and ${{ number_format(52.1429 * env('APP_PER_SUBSCRIBER'),2) }} per year.</li>
						<li>Set small goals. Start with 1 subscriber per day.</li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
