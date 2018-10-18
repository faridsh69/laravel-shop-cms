@extends('admin.dashboard')
@section('title', 'تنظیمات')
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
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				تنظیمات
			</div>
			<div class="half-seperate"></div>
			<div class="reponsive-table">
				<table class="table table-striped">
				<thead>
				<tr>
					<th>
						شماره
					</th>
					<th>
						عنوان
					</th>
					<th>
						مقدار
					</th>
					<th class="hidden-xs">
						توضیحات
					</th>
					
					<th>
						عملیات
					</th>
				</tr>
				</thead>
				<tbody>
					@if( count($settings) == 0 )
					<tr>
						<td colspan="10">
							<div class="alert">
								موردی یافت نشد !
							</div>
						</td>
					</tr>
					@endif
					@foreach($settings as $setting)
					<tr>
						<td class="text-center width-50px" >
							{{ $setting->id }}
						</td>
						<td class="description-div">
							{{ $setting->key }}
						</td>
						<td class="description-div">
							@if( $setting->key == 'logo' || $setting->key == 'default_image' || $setting->key == 'default_image_user' || $setting->key == 'default_image_product' || $setting->key == 'favicon')
								<img src="{{ $setting->value }}" alt="{{ $setting->key }}" width="100px">
							@else
								{{ $setting->value }}
							@endif
						</td>
						<td class="hidden-xs">
							{{ $setting->description }}
						</td>
						<td class="width-80px">
							<a href="/admin/manage/setting/{{ $setting->id }}">
								<span class="glyphicon glyphicon-eye-open"></span>
								مشاهده
							</a>
							<div class="one-third-seperate"></div>
							<a href="/admin/manage/setting/{{ $setting->id }}/edit">
								<span class="glyphicon glyphicon-pencil"></span>
								ویرایش
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
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<passport-clients></passport-clients>
		<passport-authorized-clients></passport-authorized-clients>
		<passport-personal-access-tokens></passport-personal-access-tokens>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<h4 class=""> راهنمای رنگ های سیستم </h4>
		<div class="simple-cart">
			<a href="#" class="btn btn-block color-not-seen">
				فاکتور مشاهده نشده است. هر چه سریعتر دیده شود
			</a>
		</div>
		<div class="simple-cart">
			<a href="#" class="btn btn-block color-danger">
				فاکتور باید پیگیری شود
			</a>
		</div>
		<div class="simple-cart">
			<a href="#" class="btn btn-block color-success">
				به سرانجام رسیدن فاکتور
			</a>
		</div>
		<div class="simple-cart">
			<a href="#" class="btn btn-block color-not-active">
				در حال خرید
			</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		database name: {{ config('database.connections.mysql.database') }}
		<div class="half-seperate"></div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		ایجاد نسخه backup سایت:
		<a href="{{ url('/admin/manage/command/backup-run') }}" class="btn btn-xs btn-success">
			شروع بکاپ گیری
		</a>
		
		<div class="half-seperate"></div>
		<a href="{{ url('/admin/manage/backup') }}">
			مدیریت بکاپ
		</a>
		<div class="half-seperate"></div>
		پاک کردن کش سیستم - زدن این لینک 100 درصد باید با اجازه طراح سایت باشد:
		<a href="{{ url('/admin/manage/command/config-cache') }}" class="btn btn-danger btn-xs">
			DELETE Cache
		</a>
		<div class="half-seperate"></div>
		<div class="half-seperate"></div>
		ایجاد مجدد ساختار دیتابیس - زدن این لینک 100 درصد باید با اجازه طراح سایت باشد:
		<a href="{{ url('/admin/manage/command/migrate') }}" class="btn btn-danger btn-xs">
			Migrate
		</a>
		<div class="half-seperate"></div>
	</div>
</div>

@endsection
@push('script')



@endpush