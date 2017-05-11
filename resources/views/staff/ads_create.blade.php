@extends('layouts.app')

@section('title', __('app.create_ad') )
@push('styles')
<link rel="stylesheet" href="/assets/css/croppic.css"/>
@endpush
@push('scripts')
<script src="/assets/js/croppic.min.js"></script>
<script>
    $(document).on('change','#class', function() {
        $('#ad-image').removeClass('classA').removeClass('classB');
        if( $(this).val() == 'a' )
        {
            $('#ad-image').addClass('classA');
            $('#ad-image').show();
        }
        else if( $(this).val() == 'b' )
        {
            $('#ad-image').addClass('classB');
            $('#ad-image').show();
        }
        else
        {
            $('#ad-image').hide();
        }
        cropperBox.destroy();
        eyeCandy = $('#ad-image');
        croppedOptions = {
            uploadUrl: '/staff/ads/upload',
            cropUrl: '/staff/ads/crop',
            cropData:{
                'width': (function() {
                    return $('#ad-image').width();
                })(),
                'height': (function() {
                    return $('#ad-image').height();
                })()
            }
        };
        cropperBox = new Croppic('ad-image', croppedOptions);
    });
    $('#create_ad').submit(function(e) {
        e.preventDefault();
        $('input[name=image]').val( $('.croppedImg').attr('src') );
        $(this).unbind('submit').submit();
    });
    var eyeCandy = $('#ad-image');
    var croppedOptions = {
        uploadUrl: '/staff/ads/upload',
        cropUrl: '/staff/ads/crop',
        cropData:{
            'width': (function() {
                return $('#ad-image').width();
            })(),
            'height': (function() {
                return $('#ad-image').height();
            })()
        }
    };
    var cropperBox = new Croppic('ad-image', croppedOptions);
</script>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ __('app.create_ad') }}</div>

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


                        <form method="POST" class="opt-form" id="create_ad">
                            {{ csrf_field() }}
                            @if( Auth::user()->role == 'admin' || env('APP_STAFF_AD_STATUS') != 'disabled' )
                                <div class="form-group">
                                    <select name="status" class="form-control input-lg" required>
                                        <option value="">{{ __('app.status') }}</option>
                                        <option value="enabled">{{ __('app.enabled') }}</option>
                                        <option value="disabled">{{ __('app.disabled') }}</option>
                                    </select>
                                </div>
                            @endif
                            <div class="form-group">
                                <select name="class" id="class" class="form-control input-lg" required>
                                    <option value="">{{ __('app.class') }}</option>
                                    <option value="a">{{ __('app.class_a') }}</option>
                                    <option value="b">{{ __('app.class_b') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="title" class="form-control input-lg" value="" placeholder="{{ __('app.title') }}" required />
                            </div>
                            <div class="form-group">
                                <input type="url" name="url" class="form-control input-lg" value="" placeholder="{{ __('app.url') }}" required />
                            </div>
                            <div class="form-group">
                                <select name="emails[]" class="form-control input-lg" multiple>
                                    @foreach( $choices['available'] AS $email)
                                        <option value="{{ $email->id}}">{{ __('app.id') }}: {{ $email->id }} - {{ $email->list == env('MAD_MIMI_MALES') ? __('app.males') : ( $email->list == env('MAD_MIMI_FEMALES') ? __('app.females') : ( $email->list == env('MAD_MIMI_FAMILIES') ? __('app.families') : '' ) ) }} - {{ Carbon\Carbon::parse( $email->send_date )->diffForHumans() }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="image" value="" />
                            <div style="padding:50px 0 60px;">
                                <div id="ad-image" class="classA" style="display:none;"></div>
                            </div>
                            <button type="submit" style="margin-bottom:5px;" class="btn btn-{{ env('THEME_SUBSCRIBE_BTN') }} btn-block btn-lg">{{ __('app.create_ad') }}</button>
                            <a href="{{ url('/staff/ads') }}" class="btn btn-lg btn-block btn-danger">{{ __('app.cancel_btn') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
