@extends('admin.dashboard')
@section('title', 'سفارشات')
@section('content')
<div class="row">
	<div class="col-xs-12">
    	<a href="/admin/manage/factor/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست سفارشات</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				سفارش شماره {{ $factor->id }}
			</div>
			<div class="panel-boddy">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">	
						<div class="seperate"></div>					
						<form class="form-inline" method="post" action="/admin/manage/factor/edit/product">
	                        {{ csrf_field() }}
		                    <div class="form-group">
		                        <span for="count">تغییر تعداد محصول در سبد خرید: </span>
		                        <input type="number" class="form-control input-sm" id="count" name="count" 
		                            value="1" style="width: 70px;">
		                    </div>
		                    <select class="form-control" name="product_id">
								@foreach($products as $product)
								<option value='{{$product->id}}'>
									{{ $product->title }}
								</option> 
								@endforeach
							</select>
							<input type="hidden" name="factor_id" value="{{ $factor->id }}">
		                    <button class="btn btn-danger btn-sm" type="submit">
		                        <span class="glyphicon glyphicon-shopping-cart"></span> 
		                        تغییر در سبد خرید
		                    </button>
		                </form>
						<div class="half-seperate"></div>
						<div class=" big-size">
							<div class="one-third-seperate"></div>
							<label>روش پرداخت:</label>
							{{ $factor->payment }}
							<div class="one-third-seperate"></div>
							<label>وضعیت:</label>
							{{ $factor->status_translate() }}
							<div class="one-third-seperate"></div>
							<select class="form-control" 
								onchange="statusChanged(this, {{ $factor->id }}, 'factor')">
								@foreach(\App\Models\Factor::$STATUS_ADMIN as $key => $value)
								<option value='{{$key}}' {{ $factor->status == $key ? 'selected' : '' }}> {{$value}} </option> 
								@endforeach
							</select>
						</div>
						<hr>
						@each('common.factor-box', [$factor], 'factor')
						<hr>
						<label>پرداخت ها:</label>
						@each('common.payment-box', [$factor], 'factor')
						<hr>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@push('script')
<script src="{{ asset('js/sort.js') }}"></script>
@endpush