<div class="row">
	@if($factor)
	<div class="col-xs-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				سفارش شما 
			</div>
	    	<div class="panel-body">
	    		<div class="row">
		    		<div class="col-sm-6">
			    		<label>شماره فاکتور:</label> {{ $factor->id }}
						<div class="one-third-seperate"></div>
						<label>روش ارسال:</label> {{ $factor->shipping }}
						<div class="one-third-seperate"></div>
						<label>
						تاریخ فاکتور: 
						</label> 
						{{ \Nopaad\jDate::forge( $factor->created_at )->format(' %Y/%m/%d - %H:%M:%S ') }}
					</div>
					<div class="col-sm-6">
						@each('common.address-box', [$factor->address], 'address')
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
								نام کالا
							</th>
							<th>
								قیمت
							</th>
							<th>
								با تخفیف
							</th>
						</tr>
						</thead>
						<tbody>
						@foreach($factor->products as $product)
						<tr>
							<td>
								{{ $product->pivot->count }}
							</td>
							<td>
								{{ $product->title }}
							</td>
							<td>
								{{ number_format($product->pivot->price) }}
							</td>
							<td>
								{{ number_format($product->pivot->discount_price) }}
							</td>
						</tr>
						@endforeach
						</tbody>
						</table>
					</div>
					<div class="col-sm-6">
						<dl class="dl-horizontal">
						  	<dt class="big-size">جمع قیمت ها</dt>
						  	<dd class="big-size">{{ number_format($factor->total_price_products()) }} تومان</dd>
						  	@foreach($factor->tagends as $tagend)
							  	<div class="half-seperate"></div>
							  	<dt>{{ $tagend->title }}</dt>
							  	<dd>{{ number_format( $tagend->pivot->value ) }} تومان</dd>
						  	@endforeach
						  	<div class="seperate"></div>
						  	<div class="seperate"></div>
						  	<dt class="double-size">هزینه قابل پرداخت</dt>
						  	<dd class="double-size">
						  		{{ number_format($factor->total_price) }} تومان</dd>
						</dl>
					</div>
				</div>
	    	</div>
	    </div>
	</div>
	@endif
</div>