@extends('layout.master-error')
@section('title', 'این متد موجود نیست')
@section('container')
  	<p><b>405.</b> <ins>متد اتصال به این آدرس اشتباه است.</ins></p>
  	<img src="{{ asset('/images/405.png') }}" class="icon">
  	<div style="direction: ltr">
        {{ $exception->getMessage() }}
        <br> File: <b>{{ $exception->getFile() }}</b> 
        <br> line: <ins>{{ $exception->getLine() }} </ins>
    </div>
    
@endsection