<!DOCTYPE html>
<html lang="{{ Lang::locale() }}" dir="{{ Lang::locale() == 'fa' ? 'rtl' : 'ltr' }}">
	<head>
		@include('common.header')
	</head>
	<body>
		<div>
			<div class="container-fluid" style="padding: 20px;">
				@yield('container')
			</div>
		</div>
		<div class="seperate"></div>
	</body>
</html>