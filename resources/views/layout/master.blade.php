<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/WebPage" lang="{{ Lang::locale() }}" dir="{{ Lang::locale() == 'fa' ? 'rtl' : 'ltr' }}">
	<head>
		@include('common.header')
	</head>
	<body>
		<div id="vue_id">
			@include('common.navbar')
			<div class="container-fluid background-container-fluid">
				@yield('container-fluid')
			</div>
			<div class="container">
				<div class="background-container">
					@yield('container')
				</div>
			</div>
			@yield('body')
		</div>
		@include('common.footer')
		@stack('initial-script')
		@include('common.script')
		@stack('script')
	</body>
</html>