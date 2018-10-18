@extends('admin.dashboard')
@section('title', 'گزارشات')
@section('content')
<sale-daily></sale-daily>
<sale-total></sale-total>
<price-chart></price-chart>
<comparison-cinema></comparison-cinema>
<comparison-daily></comparison-daily>
<comparison-theater></comparison-theater>
<comparison-total></comparison-total>
<customer-detail></customer-detail>
<last-year></last-year>
<sale-annual></sale-annual>





<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default report-panel">
			<div class="panel-heading">
				گزارشات ( این صفحه در حال به روز رسانی می باشد. )
			</div>
			<div class="panel-body">
				<div class="col-lg-3 col-md-4 col-sm-6">
					<h4 class="page-header">تعداد فاکتور ها کلا</h4> 
					<p>{{$factor_count_all}}</p>
		        </div>
		        <div class="col-lg-3 col-md-4 col-sm-6">
					<h4 class="page-header">تعداد فاکتور های ماه</h4> 
					<p>{{$factor_count_month}}</p>
		        </div>
		        <div class="col-lg-3 col-md-4 col-sm-6">
					<h4 class="page-header">تعداد فاکتور های هفته</h4> 
					<p>{{$factor_count_week}}</p>
		        </div>
		        <div class="col-lg-3 col-md-4 col-sm-6">
					<h4 class="page-header">تعداد فاکتور های امروز</h4> 
					<p>{{$factor_count_today}}</p>
		        </div>
		        <div class="col-xs-12">
			        <hr>
		        </div>
		        <!-- factor_total_price -->
		        <div class="col-lg-3 col-md-4 col-sm-6">
					<h4 class="page-header">جمع فاکتور ها کلا</h4> 
					<p>{{ number_format( $factor_total_price_all )}} تومان</p>
		        </div>
		        <div class="col-lg-3 col-md-4 col-sm-6">
					<h4 class="page-header">جمع فاکتور های ماه</h4> 
					<p>{{ number_format( $factor_total_price_month)}} تومان</p>
		        </div>
		        <div class="col-lg-3 col-md-4 col-sm-6">
					<h4 class="page-header">جمع فاکتور های هفته</h4> 
					<p>{{ number_format( $factor_total_price_week)}} تومان</p>
		        </div>
		        <div class="col-lg-3 col-md-4 col-sm-6">
					<h4 class="page-header">جمع فاکتور های امروز</h4> 
					<p>{{ number_format( $factor_total_price_today)}} تومان</p>
		        </div>
		        <div class="col-xs-12">
			        <hr>
		        </div>
		        <!-- مشتریان و کاربران سایت -->
		        <div class="col-lg-3 col-md-4 col-sm-6">
					<h4 class="page-header">تعداد کاربران کلا</h4> 
					<p>{{$user_all}}</p>
		        </div>
		        <div class="col-lg-3 col-md-4 col-sm-6">
					<h4 class="page-header">تعداد کاربران ماه</h4> 
					<p>{{$user_month}}</p>
		        </div>
		        <div class="col-lg-3 col-md-4 col-sm-6">
					<h4 class="page-header">تعداد کاربران هفته</h4> 
					<p>{{$user_week}}</p>
		        </div>
		        <div class="col-lg-3 col-md-4 col-sm-6">
					<h4 class="page-header">تعداد کاربران امروز</h4> 
					<p>{{$user_today}}</p>
		        </div>
		        <div class="col-xs-12">
			        <hr>
		        </div>
		        <!-- vorode karbaran -->
		        <div class="col-lg-3 col-md-4 col-sm-6">
					<h4 class="page-header">تعداد ورود کاربران کلا</h4> 
					<p>{{$user_login_all}}</p>
		        </div>
		        <div class="col-lg-3 col-md-4 col-sm-6">
					<h4 class="page-header">تعداد ورود  کاربران ماه</h4> 
					<p>{{$user_login_month}}</p>
		        </div>
		        <div class="col-lg-3 col-md-4 col-sm-6">
					<h4 class="page-header">تعداد ورود  کاربران هفته</h4> 
					<p>{{$user_login_week}}</p>
		        </div>
		        <div class="col-lg-3 col-md-4 col-sm-6">
					<h4 class="page-header">تعداد ورود  کاربران امروز</h4> 
					<p>{{$user_login_today}}</p>
		        </div>
		        <div class="col-xs-12">
			        <hr>
		        </div>
		        <!-- dar ham -->


		        <div class="col-lg-3 col-md-4 col-sm-6">
					<h4 class="page-header">کل پست ها و پاسخ ها</h4> 
					<p>{{$forum_all}}</p>
		        </div><div class="col-lg-3 col-md-4 col-sm-6">
					<h4 class="page-header">کل پست ها و پاسخ های فعال</h4> 
					<p>{{$forum_active}}</p>
		        </div><div class="col-lg-3 col-md-4 col-sm-6">
					<h4 class="page-header">کل پست ها</h4> 
					<p>{{$forum_post}}</p>
		        </div><div class="col-lg-3 col-md-4 col-sm-6">
					<h4 class="page-header">آگهی های فعال</h4> 
					<p>{{$advertise_active}}</p>
		        </div>
				<div class="col-lg-3 col-md-4 col-sm-6">
					<h4 class="page-header">تعداد محصولات</h4> 
					<p>{{$product_all}}</p>
		        </div><div class="col-lg-3 col-md-4 col-sm-6">
					<h4 class="page-header">تعداد محصولات در دسترس</h4> 
					<p>{{$product_available}}</p>
		        </div><div class="col-lg-3 col-md-4 col-sm-6">
					<h4 class="page-header">آگهی ها</h4> 
					<p>{{$advertise}}</p>
		        </div>

	        </div>
		</div>
	</div>
</div>
@endsection
