@extends('admin.dashboard')
@section('title', 'سفارشات')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
		<div class="panel-heading">سفارشات</div>
		<!-- <button onclick="notifyMe()">رفرش</button> -->
		<!-- <form class="form-inline" method="GET">
		  	<div class="form-group">
		    	<label for="name">نام رستوران:</label>
		   	 	<input type="text" class="form-control input-sm" id="name" name="name">
		  	</div>
		  	<button type="submit" class="btn btn-default input-sm">جستجو</button>
		</form> -->
		<div class="table-responsive">
		<table class="table table-hover">
			<tr>
				<th width="40">شناسه</th>
				@if($use == 'manage')
				<th style="min-width: 40px;max-width: 90px">کاربر</th>
				@endif
				<th style="min-width: 40px;max-width: 60px">عملیات</th>
				<th>وضعیت</th>
				<th style="min-width: 240px;max-width: 260px">محصولات</th>
				<th>مبلغ</th>
				<th>تاریخ</th>
				<th style="min-width: 40px;max-width: 60px">آدرس</th>
				<th style="min-width: 40px;max-width: 60px">توضیحات</th>
			</tr>
			@foreach($orders as $order)
				<tr class="{{ $order->status == 'receive' || $order->status == 'receivewillpay' ? 'success' : ''}}">
					<td class="text-center">{{ \Nopaad\Persian::correct( $order->id ) }}</td>	
					@if( $use == 'manage')
					<td>
						@if( $order->user )
						{{ $order->user->first_name }} {{ $order->user->last_name }}
						<br>
						{{ $order->user->phone }}
						<!-- <br> -->
						<!-- {{ $order->user->email }} -->
						@else
						هنوز تعیین نشده
						@endif
					</td>
					@endif
					<td class="text-center">
						@if( $use == 'manage' )
							@if( $order->status == 'paid' || $order->status == 'willpay' || $order->status == 'paycredit')
								<a href="/admin/approve/{{ $order->id }}" id="notifyMeId" class="btn btn-success btn-sm">
									<span class="glyphicon glyphicon-ok"></span>
									@if($order->status == 'willpay')
									تایید و دریافت هزینه در محل
									@else
									تایید
									@endif
								</a>
							 	<div class="half-seperate"></div>
								<a class="btn btn-info btn-xs" id="notifyMeId" href="/admin/order/manage/edit/{{$order->id}}">
								<span class="glyphicon glyphicon-pencil"></span> ویرایش</a>
							@elseif( $order->status == 'prepare' || $order->status == 'preparewillpay' )
								<a href="/admin/send/{{ $order->id }}" class="btn btn-primary btn-sm" id="notifyMeId">
								@if($order->status == 'preparewillpay')
								ارسال و دریافت هزینه در محل
								@else
								ارسال
								@endif
								</a>
							@elseif( $order->status == 'send' || $order->status == 'sendwillpay' )
								<a href="/admin/receive/{{ $order->id }}" id="notifyMeId" class="btn btn-success btn-sm">
								@if($order->status == 'sendwillpay')
									به مشتری رسید و هزینه در محل دریافت شد
								@else
									تحویل داده شد
								@endif
								</a>	
							 	<div class="half-seperate"></div>
								<a href="/admin/reject/{{ $order->id }}" id="notifyMeId" class="btn btn-danger btn-sm">
								@if($order->status == 'sendwillpay')
									کنسل شد و هزینه دریافت نشد
								@else
									کنسل شد
								@endif
								</a>
							@elseif( $order->status == 'receive' )
								تحویل داده شد
							@elseif( $order->status == 'receivewillpay' )
								تحویل داده شد و هزینه گرفته شد
							@elseif( $order->status == 'reject' )
								ارسال ناموفق
							@elseif( $order->status == 'rejectwillpay' )
								ارسال ناموفق و پولی داده نشد
							@endif
						@else
							@if( $order->status == 'select' || $order->status == 'address' || $order->status == 'checkout' || $order->status == 'failed' )
							<a href="/sabadekharid" class="btn btn-primary">
							ادامه
							</a>
							@endif
						@endif
					 	<div class="half-seperate"></div>	
						<a href="/admin/print/{{ $order->id }}" class="btn btn-xs btn-default">
						<span class="glyphicon glyphicon-print"></span>
						چاپ
						</a>
					</td>
					<td>
						{{ trans('statuses.' . $order->status) }}
					</td>
					<td>
					@foreach( $order->uniqe_products as $food)
					<div>
						<label class="label label-success" style="font-size: 85%">
							{{ \Nopaad\Persian::correct( $food->count() ) }} عدد</label> 
						{{ $food[0]->name }}
						<small>
							({{ \Nopaad\Persian::correct( number_format( $food[0]->price * $food->count() , 0, '',',') )  }} تومان)
						</small>
					</div>
					<div class="half-seperate"></div>
					@endforeach
					</td>
					<td>
						{{ \Nopaad\Persian::correct( number_format( $order->price, 0, '',',') ) }} تومان
					</td>
					<td>
						{{ \Nopaad\jDate::forge( $order->updated_at )->format(' %H:%M:%S') }}
						<br>
						{{ \Nopaad\jDate::forge( $order->updated_at )->format(' %Y/%m/%d') }}
					</td>
					<td>
					@if($order->address)
						{{ $order->address->name }}
			    		<div class="half-seperate"></div>
			    		{{  $order->address->reciever }} - {{ $order->address->phone }}
			    		@if($order->address->sabet)
			    		<span> -				    		
			    		{{ $order->address->sabet }}
			    		</span>
			    		@endif
			    		@if($order->address->postal_code)
			    		<span> 
			    		کدپستی‌:
			    		{{ $order->address->postal_code}}
			    		</span>
			    		@endif
					@endif	
					</td>
					<td class="text-center">{{ $order->description }}</td>
				</tr>
			@endforeach
		</table>
		</div>
		</div>
	</div>
</div>
<div class="row text-center">
	<div class="col-xs-12">
		{{ $orders->links() }}
	</div>
</div>
@endsection
@push('script')
<script>
    var time = new Date().getTime();
    $(document.body).bind("mousemove keypress", function(e) {
        time = new Date().getTime();
    });

  	function refresh() {
        if(new Date().getTime() - time >= 40000) 
            window.location.reload(true);
        else 
            setTimeout(refresh, 4000);
    }
    setTimeout(refresh, 40000);
</script>

<script type="text/javascript">
@if($use == 'restaurant' || $use == 'manage')
document.addEventListener('DOMContentLoaded', function () {
  	if (!Notification) {
    	alert('Desktop notifications not available in your browser. Try Chromium.'); 
    	return;
  	}

  	if (Notification.permission !== "granted")
    	Notification.requestPermission();
});
if( $('#notifyMeId').length > 0 )
{
	notifyMe();
}
function notifyMe() {
  	if (Notification.permission !== "granted")
    	Notification.requestPermission();
  	else {
    	var notification = new Notification('سفارش جدید رسید !', {
      	icon: '{{ url("/") }}/public/img/restaurant.png',
      	body: "سفارش را بررسی کنید و غذاها را آماده نمایید.",
    	});
    }
    // notification.onclick = function () {
    //   	window.open(" {{ url('/') }}/admin/restaurant/my-order");      
    // };
}
@endif
</script>
@endpush