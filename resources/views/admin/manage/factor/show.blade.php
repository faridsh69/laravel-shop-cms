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
				<a href="/admin/manage/factor/{{$factor->id}}/edit" class="btn btn-info btn-xs">
        			<span class="glyphicon glyphicon-pencil"></span> ویرایش </a>
			</div>
			<div class="panel-boddy">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1 col-xs-offset-0">
						<div class="half-seperate"></div>
						<div class=" big-size">
							<div class="one-third-seperate"></div>
							<label>روش پرداخت:</label>
							{{ $factor->payment }}
							<div class="one-third-seperate"></div>
							<label>وضعیت سفارش:</label>
							{{ $factor->status_translate() }}
						</div>
						<div class="one-third-seperate"></div>
						@if($factor->last_payment())
							<label>وضعیت پرداخت:</label>
							{{ $factor->last_payment()->status_translate() }}
						@endif
						<hr>
						@each('common.factor-box', [$factor], 'factor')
						<hr>
						<label>پرداخت ها:</label>
						@each('common.payment-box', [$factor], 'factor')
						<hr>
			    		<div id="map"></div>
						<div class="seperate"></div>
						تاریخ آخرین تغییر:
						
						{{ \Nopaad\jDate::forge( $factor->updated_at )->format(' %Y/%m/%d') }}
						 - 
						{{ \Nopaad\jDate::forge( $factor->updated_at )->format(' %H:%M:%S') }}
						<div class="seperate"></div>

						<label>خریدار:</label>
						{{ $factor->user ? $factor->user->first_name : ''}}
						{{ $factor->user ? $factor->user->last_name : ''}}
						-
						آیدی کاربری:
						{{ $factor->user ? $factor->user->id : '-'}}
						-
						شماره تماس:
						{{ $factor->user ? $factor->user->phone : '-'}}
						<br>
						@if($factor->user)
							@foreach( $factor->user->roles()->get() as $role)
							<span class="label label-success label-simple">{{ $role->description }}</span>
							@endforeach
						@endif
						<div class="seperate"></div>
						
						<a class="btn btn-info btn-lg" href="{{ url('/admin/manage/user/'.$factor->user->id) }}" target="_blank">سابقه خرید این مشتری</a>
						<div class="seperate"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('script')




<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCaTGuyJD5pQKp9i2zkyhg5NJ76RH3vLlA&callback=initMap" type="text/javascript"></script>
<script type="text/javascript">
function initMap() {
   geocoder = new google.maps.Geocoder();
   var myOptions = {
		zoom: 12,
		center: new google.maps.LatLng( {{ $address->latitude }} , {{ $address->longitude }} ),
		mapTypeControl: true,
		mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
		navigationControl: true,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("map"), myOptions);
	   
	var marker = new google.maps.Marker({
		position: map.getCenter(),
		map: map
	});
}
</script>
@endpush