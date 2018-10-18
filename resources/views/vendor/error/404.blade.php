@extends('layout.master-error')
@section('title', 'آدرس اشتباه است')
@section('container')
  	<p><b>404.</b> <ins>آدرس وارد شده اشتباه است.</ins></p>
  	<p>لطفا از صحت آدرس وارد شده اطمینان حاصل نمایید.</p>
  	<img src="{{ asset('/images/404.jpg') }}" class="icon">
@endsection