Congratulations!<br />
You have successfully subscribed to the {{ env('APP_NAME') }} weekly coupon mailer for {{ $list }}.<br />
<br />
Coupons are sent via email each week on {{ ucfirst( env('APP_EMAIL_SEND_DAY') ) }}.<br />
<br />
Thanks,<br />
{{ env('APP_NAME') }}<br />
<br />
<br />
To unsubscribe please visit <a href="{{ url('/unsubscribe') }}">{{ url('/unsubscribe') }}</a>