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
				<a href="/admin/factor/report/excel" class="btn btn-primary btn-xs">گرفتن خروجی اکسل</a>
			</div>
			<div class="half-seperate"></div>
			<div class="col-xs-12">
				<form class="form-inline" method="GET">
				  	<div class="form-group">
				    	<label for="total_price">جمع فاکتور:</label>
				   	 	<input type="text" class="form-control input-sm" id="total_price" name="total_price" value="{{ Request::input('total_price') }}">
				  	</div>
				  	<div class="form-group">
				    	<label for="from_date">از تاریخ:</label>
		    		</div>
			    	<div class="form-group">
					  	<input type="text" id="test-date-id" name="from_date" class="form-control input-sm">
				  	</div>
				  	<div class="form-group">
				    	<label for="to_date">تا تاریخ:</label>
		    		</div>
			    	<div class="form-group">
					  	<input type="text" id="test-date2" name="to_date" class="form-control input-sm">
				  	</div>
				  	<div class="form-group">
				  		<button type="submit" class="btn btn-default">جستجو</button>
					</div>
				  	<!-- <div class="form-group"> -->
				    	<span class="margin-right-10">
				    		{{ $factors->total() }} مورد یافت شد.
				    	</span>
				    <!-- </div> -->
				  	
				</form>
	        </div>
			<div class="reponsive-table">
				<table class="table table-striped">
				<thead>
				<tr>
					<th>
						@if(Request::input('sort') == 'id')
							@if(Request::input('order') == 'asc')
								<a href="{{url()->current()}}?name={{Request::input('name')}}&category={{Request::input('category')}}&sort=id&order=desc" class="inline-flex"> شمارنده <span class="glyphicon glyphicon-chevron-down"></span></a>
							@else
								<a href="{{url()->current()}}?name={{Request::input('name')}}&category={{Request::input('category')}}&sort=id&order=asc" class="inline-flex"> شمارنده <span class="glyphicon glyphicon-chevron-up"></span></a>
							@endif
						@else
							<a href="{{url()->current()}}?name={{Request::input('name')}}&category={{Request::input('category')}}&sort=id&order=asc"> شمارنده </a>
						@endif
					</th>
					<th>
						کاربر
					</th>
					<th>
						جمع فاکتور (تومان)
					</th>
					<th>
						نحوه پرداخت
					</th>
					<th>
						نحوه ارسال
					</th>
					<th>
						وضعیت
					</th>
					<th>
						تاریخ/ساعت
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
					<tr>
						<td class="text-center width-50px" >
							{{ $factor->id }}
						</td>
						<td>
							{{ $factor->user ? $factor->user->first_name : ''}}
							{{ $factor->user ? $factor->user->last_name : ''}}
							<br>
							شماره تماس: 
							{{ $factor->user ? $factor->user->phone : ''}}
						</td>
						<td>
							{{ $factor->total_price }}
						</td>
						<td>
							{{ $factor->payment }}
						</td>
						<td >
							{{ $factor->shipping }}
						</td>
						<td>
							{{ $factor->status_translate() }}
						</td>
						<td>
							{{ \Nopaad\jDate::forge( $factor->updated_at )->format(' %Y/%m/%d') }}
							<br>
							{{ \Nopaad\jDate::forge( $factor->updated_at )->format(' %H:%M:%S') }}
						</td>
						<td class="width-80px">
							<a href="/admin/factor/{{ $factor->id }}">
								<span class="glyphicon glyphicon-eye-open"></span>
								مشاهده
							</a>
							<div class="one-third-seperate"></div>
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
<link rel="stylesheet" type="text/css" href="/css/kamadatepicker.css">
<script type="text/javascript">
	kamaDatepicker('test-date-id');
	kamaDatepicker('test-date2');
</script>

<script type="text/javascript">
	@if($query)
		var query = '{{ $query }}';
	@endif
</script>
<script src="{{ asset('js/sort.js') }}"></script>
@endpush