<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				سفارش شما 
			</div>
	    	<div class="panel-body">
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-striped table-hover table-bordered">
						<thead>
						<tr>
							<th>
								تعداد	
							</th>
							<th>
								نام کالا
							</th>
							<th>
								قیمت (تومان)
							</th>
						</tr>
						</thead>
						<tbody>
						@foreach($basket->products as $product)
						<tr>
							<td>
								{{ $product->pivot->count }}
							</td>
							<td>
								{{ $product->title }}
							</td>
							<td>
								{{ number_format($product->real_price()) }}
							</td>
						</tr>
						@endforeach
						</tbody>
						</table>
					</div>
				</div>
	    	</div>
	    </div>
	</div>
</div>