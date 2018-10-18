@extends('layout.master-error')
@section('title', 'token یافت نشد')
@section('container')
  	<p><b>499.</b> <ins>token یافت نشد.</ins></p>
  	<p>به دلیل عدم فعالیت لطفا مجددا وارد این صفحه شوید. <small> csrf_field موجود نیست. </small></p>
  	<img src="{{ asset('/images/499.jpg') }}" class="icon">
@endsection