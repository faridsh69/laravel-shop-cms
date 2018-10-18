<meta charset="utf-8">
<title>@yield('title')</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="@yield('keywords')">
<meta name="author" content="farid shahidi">
@if(Request::segment(1) == 'admin')
<meta name="viewport" content="width=470, initial-scale=0.6">
@else
<meta name="viewport" content="width=device-width, initial-scale=1">
@endif
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="description" content="@yield('description')">
<meta itemprop="name" content="@yield('title')">
<meta itemprop="description" content="@yield('description')">
<meta itemprop="image" content="@yield('image')">

<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="@yield('title')">
<meta property="og:description" content="@yield('description')">
<meta property="og:type" content="website">
<meta property="og:locale" content="fa_IR" />
<meta property="og:locale:alternate" content="ar_IR" />
<meta property="og:image" content="@yield('image')">
<meta property="og:site_name" content="{{ url('/') }}">

<meta property="twitter:card" content="summary">
<meta property="twitter:site" content="{{ url()->current() }}">
<meta property="twitter:title" content="@yield('title')">
<meta property="twitter:description" content="@yield('description')">
<meta property="twitter:creator" content="farid shahidi">
<meta property="twitter:image" content="@yield('image')">
<meta property="twitter:domain" content="{{ url('/') }}">

<link rel="canonical" href="{{ url('/') }}">

<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('upload/images/favicon_package_v0.16/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('upload/images/favicon_package_v0.16/favicon-32x32.png') }}/">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('upload/images/favicon_package_v0.16/favicon-16x16.png') }}/">
<link rel="manifest" href="{{ asset('upload/images/favicon_package_v0.16/site.webmanifest') }}/">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

<!-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/owl./theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/kamadatepicker.css') }}"> -->
<link rel="stylesheet" href="{{ asset('css/bs-rtl-awsome-owl.css') }}">
<link rel="stylesheet" href="{{ asset('css/uikit-rtl.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/jcrop.css') }}">
<link rel="stylesheet" href="{{ asset('css/wizard.css') }}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/theme1.css') }}">

<script src=" {{ asset('js/uikit.min.js') }} "></script>
@stack('style')