<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>{{ env('APP_NAME') }} - @yield('title')</title>		<!-- for Google -->	<meta name="description" content="Local coupons for the 989 area code." />	<meta name="keywords" content="" />	<meta name="author" content="Steven Sarkisian" />	<meta name="copyright" content="" />	<meta name="application-name" content="{{ env('APP_NAME') }}" />	<!-- for Facebook -->          	<meta property="og:title" content="{{ env('APP_NAME') }} - @yield('title')" />	<meta property="og:type" content="article" />	<meta property="og:image" content="{{ url('/assets/img/989coupons-fb.jpg') }}" />	<meta property="og:url" content="{{ Request::url() }}" />	<meta property="og:description" content="The best local coupons for the 989 area emailed to you weekly." />	<!-- for Twitter -->          	<meta name="twitter:card" content="summary" />	<meta name="twitter:title" content="{{ env('APP_NAME') }} - @yield('title')" />	<meta name="twitter:description" content="The best local coupons for the 989 area emailed to you weekly." />	<meta name="twitter:image" content="{{ url('/assets/img/989coupons-fb.jpg') }}" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://bootswatch.com/{{ env('APP_THEME') }}/bootstrap.min.css" crossorigin="anonymous">
	<link href="https://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="/assets/css/style.css" rel="stylesheet">
      @stack('styles')
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->	<script>	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');	  ga('create', 'UA-99005856-1', 'auto');	  ga('send', 'pageview');	</script>
  </head>
  <body>
	@include('blocks.header')
	<div class="container">
		@yield('content')
		@include('blocks.footer')
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="/assets/js/script.js"></script>
	@stack('scripts')
  </body>
</html>