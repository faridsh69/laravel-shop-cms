@extends('layout.master-error')
@section('title', 'دسترسی غیر مجاز')
@section('container')
  	<p><b>403.</b> <ins>شما اجازه دسترسی به این صفحه ندارید.</ins></p>
  	<p>نقش شما در سایت تعیین کننده این اجازه می باشد.</p>
  	<img src="{{ asset('/images/403.jpg') }}" class="icon">
@endsection