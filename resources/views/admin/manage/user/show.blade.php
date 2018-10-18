@extends('admin.dashboard')
@section('title', 'کاربران')
@section('content')
<div class="row">
	<div class="col-xs-12">
    	<a href="/admin/manage/user/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست کاربران</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				کاربر شماره {{ $user->id }}
<!-- 				<a href="/admin/manage/user/{{$user->id}}/edit" class="btn btn-info btn-xs">
        			<span class="glyphicon glyphicon-pencil"></span> ویرایش </a>
 -->			</div>
			<div class="panel-boddy">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="half-seperate"></div>
						<div>
							<h4>
								مشخصات کاربر:
							</h4>
							نام: 
							{{ $user->first_name }}
							<div class="one-third-seperate"></div>
							نام خانوادگی: 
							{{ $user->last_name }}
							<div class="one-third-seperate"></div>
							وضعیت: 
							{{ $user->status_translate() }}
							<div class="one-third-seperate"></div>
							شماره تماس: 
							{{ $user->phone }}
							<div class="one-third-seperate"></div>
							ایمیل: 
							{{ $user->email }}
							<div class="one-third-seperate"></div>
							تاریخ ایجاد کاربر: 
							{{ \Nopaad\jDate::forge( $user->updated_at )->format(' %Y/%m/%d') }}
							 - 
							{{ \Nopaad\jDate::forge( $user->updated_at )->format(' %H:%M:%S') }}
							<div class="one-third-seperate"></div>
							تاریخ آپدیت کاربر: 
							{{ \Nopaad\jDate::forge( $user->created_at )->format(' %Y/%m/%d') }}
							 - 
							{{ \Nopaad\jDate::forge( $user->created_at )->format(' %H:%M:%S') }}
							<div class="half-seperate"></div>
							نقش های کاربر:
							@foreach( $user->roles()->get() as $role)
								<span class="label label-success label-simple">
									{{ $role->description }}
								</span>
							@endforeach
							<div class="half-seperate"></div>
							<h5> <b>
							3 زمان آخرین ورود کاربر: </b>
							</h5>
							<div class="one-third-seperate"></div>
							@foreach( $user->user_logins()->take(3)->get() as $user_login)
								
							{{ \Nopaad\jDate::forge( $user_login->created_at )->format(' %Y/%m/%d') }}
							 		- 
							{{ \Nopaad\jDate::forge( $user_login->created_at )->format(' %H:%M:%S') }}
							<div class="half-seperate"></div>
							@endforeach
							<div class="seperate"></div>
							{{ $user->total }} 
						</div>
						<hr>
						<div>
							<h4>
								آدرس های کاربر
							</h4>
							@if( count( $user->addresses ) == 0 )
								<div class="help-block"> آدرسی تاکنون وارد نکرده است‌. </div>
							@else
							<ol>
								@foreach( $user->addresses as $address)
								<li>
						    		<div class="one-third-seperate"></div>
						    		{{ $address->display_name ? 'نام : ' . $address->display_name : ''}} - 
						    		{{ $address->phone ? 'شماره همراه: ' . $address->phone : ''}} -
						    		{{ $address->sabet_phone ? 'شماره ثابت: ' . $address->sabet_phone : ''}}
						    		<div class="one-third-seperate"></div>
						    		{{ $address->province ? ' استان: ' . 
						    		\Config::get('constants.provinces')[$address->province] : ''}}
						    		- 
						    		{{ $address->city ? ' شهر: ' . $address->city : ''}}
						    		{{ $address->postal_code ? 'کدپستی‌: ' . $address->postal_code : ''}}
						    		<div class="one-third-seperate"></div>
						    		{{ $address->address ? 'آدرس: '.$address->address : ''}}
						    		<div class="seperate"></div>
								</li>
								@endforeach
							@endif
							</ol>
						</div>
			    		<hr>
						<label>سابقه خرید:</label>
						<div class="reponsive-table">
							<table class="table table-striped">
							<thead>
							<tr>
								<th>
									<a class="inline-flex" sort="id"> شمارنده </a>
								</th>
								<th>
									<a class="inline-flex" sort="total_price"> جمع فاکتور (تومان) </a>
								</th>
								<th>
									<a class="inline-flex" sort="payment"> نحوه پرداخت </a>
								</th>
								<th>
									<a class="inline-flex" sort="shipping"> نحوه ارسال </a>
								</th>
								<th>
									<a class="inline-flex" sort="status"> وضعیت </a>
								</th>
								<th>
									<a class="inline-flex" sort="updated_at"> تاریخ/ساعت </a>
								</th>
							</tr>
							</thead>
							<tbody>
								@if( count($user->factores) == 0 )
								<tr>
									<td colspan="10">
										<div class="alert">
											موردی یافت نشد !
										</div>
									</td>
								</tr>
								@endif
								@foreach($user->factores as $factor)
								<tr  class="
									@if($factor->status < 3) color-not-active @endif
									@if($factor->status > 2 && $factor->status < 6) color-danger @endif
									@if($factor->status > 5) color-success @endif
									@if($factor->admin_seen === 0) color-not-seen @endif 
									">
									<td class="text-center width-50px" >
										{{ $factor->id }}
									</td>
									<td>
										{{ number_format($factor->total_price) }}
									</td>
									<td>
										{{ $factor->payment }}
									</td>
									<td >
										{{ $factor->shipping }}
									</td>
									<td class="width-150px">
										{{ $factor->status_translate() }}
									</td>
									<td>
										{{ \Nopaad\jDate::forge( $factor->updated_at )->format(' %Y/%m/%d') }}
										<br>
										{{ \Nopaad\jDate::forge( $factor->updated_at )->format(' %H:%M:%S') }}
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
</div>
@endsection
@push('script')



@endpush