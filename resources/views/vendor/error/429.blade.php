@extends('layout.master-error')
@section('title', 'تعداد درخواست ها زیاد است')
@section('container')
  	<p><b>429.</b> <ins>به حد نصاب تعداد درخواست ها رسیده اید.</ins></p>
  	<p>لطفا لحظاتی دیگر مجددا تلاش کنید.</p>
  	<img src="{{ asset('/images/429.jpg') }}" class="icon">
@endsection