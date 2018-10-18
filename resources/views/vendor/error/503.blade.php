@extends('layout.master-error')
@section('title', 'به‌روز‌رسانی')
@section('container')
  	<p><b>503.</b> <ins>سایت در حال به‌روز‌رسانی می‌باشد.</ins></p>
  	<p>لطفا دقایقی دیگر مراجعه نمایید.</p>
  	<img src="{{ asset('/images/503.jpg') }}" class="icon">
@endsection