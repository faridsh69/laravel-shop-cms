@extends('layout.master')
@section('title', 'روش ارسال')
@section('container')

@each('common.form-wizard', [ ['type' => 'shipping'] ], 'form')

<div class="row">
	<div class="col-xs-12 text-center">
		<h3>
			انتخاب روش ارسال: 
		</h3>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="seperate"></div>
	 	@foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <div class="alert alert-{{ $msg }} alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul class="list-unstyled">
                        <li>{{ Session::get('alert-' . $msg) }}</li>
                    </ul>
                </div>
            @endif
        @endforeach
        @if ($errors->all())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul class="list-unstyled">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
	</div>	
</div>

<div class="seperate"></div>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-warning">
			<div class="panel-heading">
				کد تخفیف
			</div>
			<div class="panel-body">
				<div class="row">
					<form method="post" action="{{ url('/checkout/discount') }}">
						{{ csrf_field() }}
					  	<div class="form-group">
					    	<label class="col-lg-1 col-xs-2" for="code">کد <small class="hidden-xs"> تخفیف </small>: </label>
					   	 	<input class="form-control col-md-4 col-xs-4" type="text" id="code" name="code">
					   	 	<div class="col-md-6 col-xs-6">
							  	<button  class="btn btn-warning" type="submit">اعمال کد تخفیف</button>
						  	</div>
					  	</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="seperate"></div>
<form action="{{ url('/checkout/shipping') }}" method="post">
	<div class="row">
		<input type="hidden" name="factor_id" value=" {{ $factor->id }}">
		{{ csrf_field() }}
		@foreach($shippings as $shipping)
		<div class="col-xs-12 
			@if( count($shippings) == 2)
				col-sm-6
			@elseif( count($shippings) >= 3)
				col-sm-4
			@endif
			 ">
			<div class="simple-cart">
				<div class="radio-style">
					<div class="radio-button">
						<input type="radio" name="shipping" id="{{ $shipping->id }}" value="{{ $shipping->title }}" checked="">
						<label for="{{ $shipping->id }}">
					    	<span class="radio">
					    		<p class="bold"  for="{{ $shipping->id }}">
									{{ $shipping->title }}
								</p>
								<div class="help-block">
									{!! $shipping->description !!}
								</div>
								قیمت:
								{{ number_format($shipping->value) }}
								تومان
					    	</span>
				    	</label>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>

	<div class="seperate"></div>
	<div class="row">
		<div class="col-xs-12">
			<button type="submit" class="btn btn-success btn-block btn-lg">
				ادامه خرید
	  			<i class="fa fa-arrow-circle-o-left"></i>
			</button>
		</div>
	</div>
	<div class="seperate"></div>
	<div class="seperate"></div>
	@include('common.factor-box')
</form>
@endsection
