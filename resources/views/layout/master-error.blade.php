<!DOCTYPE html>
<html lang="fa" dir="rtl">
	<head>
	  	<meta charset=utf-8>
	  	<meta name=viewport content="initial-scale=1, minimum-scale=1, width=device-width">
	  	<title>@yield('title')</title>
	  	<link rel="stylesheet" type="text/css" href="{{ asset('css/error.css') }}">
	</head>
	<body>
		<a href="{{ url('/') }}" class="no-decoration">
			<h2>{{ $constant['name'] }}</h2>
			<img src="{{ asset($constant['logo']) }}" alt="{{ $constant['name'] }}" class="logo">
		</a>
		@yield('container')
  	</body>
</html>