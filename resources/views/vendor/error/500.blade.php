@extends('layout.master-error')
@section('title', 'خطا رخ داده است')
@section('container')
    <p><b>500.</b> <ins>خطا رخ داده است.</ins></p>
    <p>
        <span>اگر می‌‌خواهید به سایت خودتان خدمت کنید:</span>
        <br>
        <small>با شماره ۰۹۱۰۶۸۰۱۶۸۵ تماس گرفته و خطا زیر را گزارش دهید.</small>
    </p>
    <div style="direction: ltr; font-size: 12px">
        {{ $exception->getMessage() }}
        <br> File: <b>{{ $exception->getFile() }}</b> 
        <br> line: <ins>{{ $exception->getLine() }} </ins>
    </div>
    <!-- <img src="{{ asset('/images/500.png') }}" class="icon"> -->
@endsection
   