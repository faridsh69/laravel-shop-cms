@extends('layout.master')
@section('title', 'روش پرداخت')
@section('container')

@each('common.form-wizard', [ ['type' => 'payment'] ], 'form')

<div class="row">
	<div class="col-xs-12 text-center">
		<h3>
			انتخاب روش پرداخت: 
		</h3>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="simple-cart">
			پرداخت اینترنتی از درگاه امن بانک ملت:
			<div class="seperate"></div>
			<a href="/checkout/payment/online/mellat" class="btn btn-block btn-success">
				پرداخت اینترنتی
			</a>
		</div>
	</div>
</div>
@if( $constant['payment_local'] == 'yes' )
<div class="row">
	<div class="col-xs-12">
		<div class="simple-cart">
			می توانید هزینه را در محل پرداخت کنید.
			<div class="seperate"></div>
				<a href="{{ url('/checkout/payment/local') }}" class="btn btn-block btn-primary">پرداخت در محل</a>
		</div>
	</div>
</div>
@endif

@include('common.factor-box')

@endsection
