Hello,<br />
You've received a new message via the {{ env('APP_NAME') }} contact form.<br />
<br />
<strong>Name:<strong> {{ $input['name'] }}<br />
<strong>Email:<strong> {{ $input['email'] }}<br />
<strong>Subject:<strong> {{ $input['subject'] }}<br />
<strong>Message:<strong><br />{{ $input['message'] }}<br />
<br />
{{ env('APP_NAME') }}<br />
{{ url('/') }}