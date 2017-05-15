@extends('layouts.app')

@section('title', __('app.manage_ads') )

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="clearfix">
                    <a href="{{ url('/staff/ads/create') }}" class="btn btn-success pull-right" style="margin-bottom:10px;"><i class="fa fa-plus"></i> {{ __('app.create_ad') }}</a>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">{{ __('app.manage_ads') }}</div>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ __('app.id') }}</th>
                            <th>{{ __('app.status') }}</th>
                            <th>{{ __('app.title') }}</th>
                            <th>{{ __('app.class') }}</th>
                            <th>{{ __('app.preview') }}</th>
                            <th>{{ __('app.created_on') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $ads AS $ad )
                            <tr>
                                <td>
                                    <a class="text-info" href="{{ url('/staff/ads/edit/'.$ad->id) }}" class=""><i class="fa fa-gear"></i></a>
                                    @if( Auth::user()->role == 'admin' )
                                        <a href="{{ url('/staff/ads/delete/'.$ad->id) }}" onclick="return confirm('{{ __('app.are_you_sure_ad') }}');" class=""><i class="fa fa-trash"></i></a>
                                    @endif
                                    <a class="text-warning" href="{{ $ad->url }}" target="_blank"><i class="fa fa-eye"></i></a>
                                </td>
                                <td>{{ $ad->id }}</td>
                                <td><span class="label label-{{ $ad->status == 'enabled' ? 'success' : 'danger' }}">{{ $ad->status }}</span></td>
                                <td>{{ $ad->title }}</td>
                                <td>{{ $ad->class }}</td>
                                <td>
                                    <a href="{{ url('/uploads/cropped-'.$ad->image->filename.'.jpg') }}" target="_blank">
                                        <img style="width:100%;max-width:50px;" src="{{ url('/uploads/cropped-'.$ad->image->filename.'.jpg') }}">
                                    </a>
                                </td>
                                <td>{{ $ad->created_at->toFormattedDateString() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $ads->links() }}
            </div>
        </div>
    </div>
@endsection