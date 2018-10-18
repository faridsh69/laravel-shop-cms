@extends('admin.dashboard')
@section('title', 'سفارشات')
@section('content')
<div class="row">
	<div class="col-xs-12">
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
        
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				سفارشات
				<a href="/admin/manage/factor/report/excel" class="btn btn-primary btn-xs">گرفتن خروجی اکسل</a>
			</div>
			<div class="half-seperate"></div>
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1">
					<div class="simple-guide">
						<a href="javascript:void(0)" class="btn btn-block color-not-seen">
							فاکتور مشاهده نشده
						</a>
					</div>
					<div class="simple-guide">
						<a href="javascript:void(0)" class="btn btn-block color-danger">
							فاکتور پیگیری شود
						</a>
					</div>
					<div class="simple-guide">
						<a href="javascript:void(0)" class="btn btn-block color-success">
							به سرانجام رسیدن
						</a>
					</div>
				</div>
			</div>
			<div class="half-seperate"></div>
			<div class="col-xs-10 col-xs-offset-1">

				<form class="form-inline" method="GET">
				  	<div class="form-group">
				    	<label for="last_name">نام خانوادگی:</label>
				   	 	<input type="text" class="form-control input-sm" id="last_name" name="last_name" value="{{ 
				   	 	Request::input('last_name') }}">
				  	</div>
				  	<div class="form-group">
				  		<label for="role">وضعیت: </label>
					  	<select class="form-control" name="status" id="status">
							<option value="">همه</option>
							@foreach(\App\Models\Factor::$STATUS as $key => $value)
								<option value="{{ $key }}"
									{{ Request::input('status') == $key ? "selected" : ""}}
								> 
									{{ $value }}
								</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
				    	<label for="role">نقش کاربر: </label>
				    	<select class="form-control" name="role" id="role">
							<option value="">همه</option>
							@foreach(\App\Models\Role::get() as $role)
								<option value="{{ $role->id }}"
									{{ Request::input('role') == $role->id ? "selected" : ""}} >
									{{ $role->description }}
								</option>
							@endforeach
						</select>
				  	</div>
				  	<div class="half-seperate"></div>
				  	<div class="form-group">
				    	<input type="text" id="data-input" name="date_from" class="form-control" placeholder="تاریخ از">
				  	</div>
				  	<div class="form-group">
				    	<input type="text" id="data-input2" name="date_to" class="form-control" placeholder="تاریخ تا">
				  	</div>
				  	<button type="submit" class="btn btn-default">جستجو</button>
			    	<span class="margin-right-10">
			    		{{ $factors->total() }} مورد یافت شد.
			    	</span>
				</form>
	        </div>
			<div class="reponsive-table">
				<table class="table table-striped">
				<thead>
				<tr>
					<th>
						<a class="inline-flex" sort="id"> شمارنده </a>
					</th>
					<th>
						<a class="inline-flex" sort="user"> کاربر </a>
					</th>
					<th>
						<a class="inline-flex" sort="total_price"> جمع فاکتور </a>
					</th>
					<th>
						<a class="inline-flex" sort="payment"> پرداخت / ارسال </a>
					</th>
					<th>
						<a class="inline-flex" sort="status"> وضعیت </a>
					</th>
					<th class="hidden-xs">
						<a class="inline-flex " sort="created_at"> تاریخ/ساعت </a>
					</th>
					<th>
						عملیات
					</th>
				</tr>
				</thead>
				<tbody>
					@if( count($factors) == 0 )
					<tr>
						<td colspan="10">
							<div class="alert">
								موردی یافت نشد !
							</div>
						</td>
					</tr>
					@endif
					@foreach($factors as $factor)
					<tr  class="
						@if($factor->admin_seen == 0) color-not-seen @endif 
						@if($factor->status > 2 && $factor->status < 6) color-danger @endif
						@if($factor->status > 5) color-success @endif
						@if($factor->status < 3) color-not-active @endif
						">
						<td class="text-center width-50px" >
							{{ $factor->id }}
							<div class="half-seperate"></div>
							<!-- کد پیگیری:
							{{ 93832 - ( ( $factor->id % 10 ) * 30000 ) + 80000 }} -->
						</td>
						<td>
							{{ $factor->user ? $factor->user->first_name : ''}}
							{{ $factor->user ? $factor->user->last_name : ''}}
							<br>
							شماره تماس: 
							{{ $factor->user ? $factor->user->phone : ''}}
							<br>
							@if($factor->user)
							@foreach( $factor->user->roles()->get() as $role)
							<span class="label label-success label-simple">{{ $role->description }}</span>
							@endforeach
							@endif
						</td>
						<td>
							{{ number_format($factor->total_price) }}
						</td>
						<td>
							{{ $factor->payment ? $factor->payment : 'روش پرداخت تعیین نشده'}}
							<div class="half-seperate"></div>
							<div class="half-seperate"></div>
							{{ $factor->shipping }}
						</td>
						<td class="width-150px">
							{{ $factor->status_translate() }}
							<div class="half-seperate"></div>
							<div class="half-seperate"></div>

							{!! $factor->admin_seen == 1 ? '<lable class="label label-success"> فاکتور دیده شده</lable>' : '<lable class="label label-danger"> فاکتور را مشاهده کنید!</lable>' !!}
						</td>
						<td class="hidden-xs">
							{{ \Nopaad\jDate::forge( $factor->created_at )->format(' %Y/%m/%d') }}
							<br>
							{{ \Nopaad\jDate::forge( $factor->created_at )->format(' %H:%M:%S') }}
						</td>
						<td class="width-80px">
							<a href="/admin/manage/factor/{{ $factor->id }}">
								<span class="glyphicon glyphicon-eye-open"></span>
								مشاهده
							</a>
							<div class="one-third-seperate"></div>
							<a href="/admin/manage/factor/{{ $factor->id }}/edit">
								<span class="glyphicon glyphicon-pencil"></span>
								ویرایش
							</a>
							<div class="one-third-seperate"></div>
							<a href="/admin/manage/factor/{{ $factor->id }}/print" class="btn btn-xs btn-primary">
								<span class="glyphicon glyphicon-pencil"></span>
								پرینت
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="text-center">
			{{ $factors->links() }}
		</div>
	</div>
</div>
@endsection
@push('script')

<script type="text/javascript">
	@if($query)
		var query = '{{ $query }}';
	@endif
</script>
<script src="{{ asset('js/sort.js') }}"></script>

<script type="text/javascript">
	kamaDatepicker('data-input');
	kamaDatepicker('data-input2');
</script>


<script>
	var notified = false;
	var time = new Date().getTime();
	$(document.body).bind("mousemove keypress", function(e) {
	    time = new Date().getTime();
	});

	function refresh() {
	    if(new Date().getTime() - time >= 40000) 
	    {
	    	if(notified == false)
	    	{
		        window.location.reload(true);
	    	}
	    }
	    else 
	    {
	        setTimeout(refresh, 60000);
	    }
	}
	setTimeout(refresh, 10000);

	document.addEventListener('DOMContentLoaded', function () {
	  	if (!Notification) {
	    	alert('Desktop notifications not available in your browser. Try Chromium.'); 
	    	return;
	  	}

	  	if (Notification.permission !== "granted")
	    	Notification.requestPermission();
	});
	if( $('.color-not-seen').length > 0 )
	{
		notifyMe();
	}
	function notifyMe() {
	  	if (Notification.permission !== "granted")
	  	{
	    	Notification.requestPermission();
	  	}
	  	else {
	  		console.log('bb');
	    	var notification = new Notification('سفارش جدید رسید !', {
		      	icon: 'http://shomalapp.com/public/img/restaurant.png',
		      	body: "سفارش را بررسی کنید و کالاها را آماده نمایید.",
	    	});
	    	notification.onclick = function () {
		      	window.open("/factor/index");      
		    };
	    }
	    notified = true;
	}
</script>
@endpush