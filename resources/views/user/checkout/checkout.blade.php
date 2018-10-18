<!-- @extends('layout.master')
@section('container')
<div class="seperate"></div>
<div class="row">
	<div class="col-xs-12">
		<h4>
			انتخاب روش پرداخت: 
		</h4>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="cart">
			پرداخت اینترنتی از درگاه امن بانک:
			<div class="seperate"></div>
			<a href="/payment/{{Request::segment(2)}}" class="btn btn-block btn-success">
				پرداخت اینترنتی
			</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="cart">
			اگر حداقل <b> یک بار پرداخت آنلاین </b> داشته باشید می توانید هزینه را در محل پرداخت کنید.
			<div class="seperate"></div>
			@if( \App\Models\Order::where('user_id',\Auth::user()->id )->where('status','receive')->count() > 0 )
				<a href="/paymentInLocation/{{Request::segment(2)}}" class="btn btn-block btn-primary">پرداخت در محل</a>
			@else
			     <button class="btn btn-primary btn-block" onclick="alert('تاکنون سفارش آنلاین نداشتید.')">پرداخت در محل</button>
			@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="cart">
			اگر اعتبار کافی دارید می توانید با اعتبار خود پرداخت نمایید.
			<div class="seperate"></div>
			@if(\Auth::user()->credit > $order->price)
				<a href="/paymentWithCredit/{{Request::segment(2)}}" class="btn btn-block btn-info">پرداخت با اعتبار</a>
			@else
			     <button class="btn btn-info btn-block" onclick="alert('اعتبار شما کافی نیست')">پرداخت با اعتبار</button>
			@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="cart">
			برای مبالغ بیش از ۳ ملیون تومان می توانید عملیات کارت به کارت را انجام دهید.
			<div class="seperate"></div>
			<a href="javascript:void(0)" class="btn btn-block btn-danger">ورود اطلاعات کارت به کارت </a>
		</div>
	</div>
</div>

<div class="seperate"></div>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-success">
			<div class="panel-heading">
				سفارش شما  در *** <span class="double-size bold">{{ $constant['name']}}</span>***
			</div>
	    	<div class="panel-body">
	    		<div class="row">
		    		<div class="col-xs-6">
			    		<label>
			    		شماره فاکتور:
			    		</label>
						{{ \Nopaad\Persian::correct($order->id) }}
					</div>
					<div class="col-xs-6">
						<label>
						تاریخ فاکتور: 
						</label> 
						{{ \Nopaad\jDate::forge( $order->updated_at )->format(' %Y/%m/%d - %H:%M:%S ') }}
					</div>
				</div>	
				<div class="row">
					<div class="col-xs-12">
						<hr>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<table class="table table-striped table-hover">
						<thead>
						<tr>
							<th>
								تعداد	
							</th>
							<th>
								نام غذا
							</th>
							<th>
								قیمت
							</th>
							<th>
								با تخفیف
							</th>
							<th>
								مبلغ
							</th>
						</tr>
						</thead>
						<tbody>
						@foreach($products->unique('name') as $product)
						<tr>
							<td>
								{{  \Nopaad\Persian::correct($products->where('name',$product->name)->count()) }}
							</td>
							<td>
								{{ $product->name }}
							</td>
							<td>
								{{ \Nopaad\Persian::correct( number_format($product->price, 0, '',',') ) }}
							</td>
							<td>
								{{  \Nopaad\Persian::correct( number_format( $product->price * (100 - \App\Http\Controllers\Controller::OFF ) / 100) , 0, '',',')  }}
							</td>
							<td>
								{{  \Nopaad\Persian::correct( number_format(
								$products->where('name',$product->name)->count() * $product->price * (100 - \App\Http\Controllers\Controller::OFF ) / 100
								, 0, '',',')) }}
							</td>
						</tr>
						@endforeach
						</tbody>
						</table>
					</div>
					<div class="col-sm-6">
						<div class="seperate"></div>
						<dl class="dl-horizontal">
						  	<dt>جمع کل هزینه ها</dt>
						  	<dd>{{  \Nopaad\Persian::correct(  number_format( $products->sum('price'), 0, '',',') ) }} تومان</dd>
						  	<div class="half-seperate"></div>
						  	<dt>جمع هزینه ها پس از تخفیف</dt>
						  	<dd>{{  \Nopaad\Persian::correct(  number_format($products->sum('price') * (100 - \App\Http\Controllers\Controller::OFF ) / 100 , 0, '',',')) }} تومان</dd>
						  	<div class="half-seperate"></div>
						  	<dt>هزینه ارسال</dt>
						  	<dd>{{ \Nopaad\Persian::correct( number_format( \App\Http\Controllers\Controller::PEYK ), 0, '',',') }} تومان</dd>
						  	<div class="half-seperate"></div>
						  	<dt class="double-size">هزینه قابل پرداخت</dt>
						  	<dd class="double-size">{{ \Nopaad\Persian::correct(  number_format( $products->sum('price') * (100 - \App\Http\Controllers\Controller::OFF ) / 100 + \App\Http\Controllers\Controller::PEYK , 0, '',',')) }} تومان</dd>
						  	<div class="seperate"></div>
						</dl>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<hr>
						<label>آدرس دریافتی:</label>
						<span>
							{{ $order->address->name }}
						</span>
						<br>
						<label>شماره همراه شما:</label>
						<span>
							{{ \Auth::user()->phone}}
						</span>
					</div>
				</div>
	    	</div>
	    </div>
	</div>
</div>
@endsection
 -->