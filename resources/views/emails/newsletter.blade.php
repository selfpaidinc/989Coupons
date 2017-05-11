<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/email.css" >
</head>
<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
<table class="head-wrap" bgcolor="#999999">
    <tr>
        <td></td>
        <td class="header container" align="">
            <div class="content">
                <table bgcolor="#999999" >
                    <tr>
                        <td><img src="http://placehold.it/200x50/?text=989+Coupons" /></td>
                        <td align="right"><h6 class="collapse">Weekly Coupons</h6></td>
                    </tr>
                </table>
            </div>
        </td>
        <td></td>
    </tr>
</table>
<table class="body-wrap" bgcolor="">
    <tr>
        <td></td>
        <td class="container" align="" bgcolor="#FFFFFF">
            <div class="content">
                <table>
                    <tr>
                        <td>
                            @if( isset( $ads['a'] ) )
                            <p><a target="_blank" href="{{ $ads['a']->url }}"><img src="{{ url('/uploads/cropped-'.$ads['a']->image->filename.'.jpg') }}" /></a></p><!-- /hero -->
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <?php
                $couponCount = count( $email->coupons );
                $half = round( $couponCount * .5 );
                $i=1;
            ?>
            @foreach( $email->coupons AS $coupon )
            <div class="content">
                <table bgcolor="">
                    <tr>
                        <td>
                            <h4>{{ $coupon->title }} <small>{{ Carbon\Carbon::parse( $coupon->barcode_begins )->toFormattedDateString() }} - {{ Carbon\Carbon::parse( $coupon->barcode_ends )->toFormattedDateString() }}</small></h4>
                            <p class="">{{ $coupon->description }} </p>
                            <a href="{{ url('/coupon/'.$coupon->id) }}" class="btn">View Coupon &raquo;</a>
                        </td>
                    </tr>
                </table>
            </div>
                @if( $i == $half )
                        <div class="content"><table bgcolor="">
                                <tr>
                                    @if( !empty( $ads['b'] ) )
                                        @foreach( $ads['b'] AS $ad )
                                            <td align="center"><a target="_blank" href="{{ $ad->url }}"><img src="{{ url('/uploads/cropped-'.$ad->image->filename.'.jpg') }}" /></a></td>
                                        @endforeach
                                    @endif
                                    @if( count( $ads['b'] ) < 4 )
                                        <td align="center"><a target="_blank" href="{{ url('/advertise') }}"><img src="{{ url('/assets/img/demo-block.jpg') }}" /></a></td>
                                    @endif
                                </tr>
                            </table>
						</div>
                @endif
                <?php $i++; ?>
            @endforeach
            <div class="content">
                <table bgcolor="">
                    <tr>
                        <td>
                            <table bgcolor="" class="social" width="100%">
                                <tr>
                                    <td>
                                        <div class="column">
                                            <table bgcolor="" cellpadding="" align="left">
                                                <tr>
                                                    <td>

                                                        <h5 class="">Connect with Us:</h5>
                                                        <p class=""><a href="#" class="soc-btn fb">Facebook</a> <a href="#" class="soc-btn tw">Twitter</a> <a href="#" class="soc-btn gp">Google+</a></p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="column">
                                            <table bgcolor="" cellpadding="" align="left">
                                                <tr>
                                                    <td>

                                                        <h5 class="">Contact Info:</h5>
                                                        <p>Phone: <strong>{{ env('APP_CONTACT_PHONE') }}</strong><br/>
                                                            Email: <strong><a href="emailto:{{ env('APP_CONTACT_EMAIL') }}">{{ env('APP_CONTACT_EMAIL') }}</a></strong></p>

                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="clear"></div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
        <td></td>
    </tr>
</table>
<table class="footer-wrap">
    <tr>
        <td></td>
        <td class="container">
            <div class="content">
                <table>
                    <tr>
                        <td align="center">
                            <p>
                                <a href="#">Terms</a> |
                                <a href="#">Privacy</a> |
                                <a href="{{ url('/unsubscribe?email=') }}"><unsubscribe>Unsubscribe</unsubscribe></a>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
        <td></td>
    </tr>
</table>
</body>
</html>