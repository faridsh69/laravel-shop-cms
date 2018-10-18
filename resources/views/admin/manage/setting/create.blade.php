@extends('admin.dashboard')
@section('title', 'تنظیمات')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<a href="/admin/manage/setting/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست تنظیمات</a>
        <div class="half-seperate"></div>
		@if(isset($setting) )
		<form enctype="multipart/form-data" method="post" action="/admin/manage/setting/{{$setting->id}}" id="form">
			{{ method_field('PUT') }}
		@else
		<form enctype="multipart/form-data" method="post" action="/admin/manage/setting/0" id="form">
		@endif
			{{ csrf_field() }}
			<div class="panel {{ Request::segment(4) == 'edit' ? 'panel-info' :'panel-success'}} panel-default">
				<div class="panel-heading">
					@if(Request::segment(4) == 'edit')
						ویرایش ویژگی شماره: 
						{{ $setting->id }}
						-
						{{ $setting->title }}
					@else
						ایجاد ویژگی جدید
					@endif
					@if( isset($setting) )
						<input type="hidden" name="id" value="{{ $setting->id }}">
					@endif
				</div>
				<div class="half-seperate"></div>
				@if ($errors->all())
	            <div class="alert alert-danger alert-dismissible" role="alert">
	                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	                <ul class="list-unstyled">
	                @foreach($errors->all() as $error)
	                    <li>{{ $error }}</li>
	                @endforeach
	                </ul>
	            </div>
	        	@endif
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
	            <div class="one-third-seperate"></div>
            	<div class="table-responsive">
					<table class="table table-striped">
						<tr>
							<td><b>عنوان *</b></td>
							<td><input type="text" name="key" class="form-control"
							value="{{ $setting->key or old('key') }}" disabled="" required></td>
						</tr>
						<tr>
							<td width="120px;">توضیحات</td>
							<td><input type="text" name="description" class="form-control"
							value="{{ $setting->description or old('description') }}" disabled=""></td>
						</tr>
						<tr>
							<td>مقدار</td>
							<td>
								@if( $setting->key == 'logo' || $setting->key == 'default_image' || $setting->key == 'default_image_user' || $setting->key == 'default_image_product' || $setting->key == 'favicon')
								<input type="file" name="value" class="form-control">
								<div class="help-block">سایز تصویر حداقل ۱۵۰ * ۱۵۰ پیکسل باشد</div>
								@elseif( $setting->key == 'theme' )
									<select name="value" class="form-control">
										<option value="default">پیش فرض</option>
										<option value="digikala">مشابه دیجیکالا</option>
										<option value="news">اخبار</option>
										<option value="konkor">کنکوری</option>
										<option value="developer">طراحی سایت</option>
										<option value="holo">فروشگاه تک محصولی</option>
									</select>
									<div class="help-block">این بخش را تغییر ندهید.</div>
								@elseif( $setting->key == 'payment_local' )
									<select name="value" class="form-control">
										<option value="yes">yes</option>
										<option value="no">no</option>
									</select>
								@else
									<input type="text" name="value" class="form-control" value="{{ $setting->value or old('value') }}">
								@endif
							</td>
						</tr>
						<tr>
							<td colspan="20">
							<div class="col-xs-12">
								<button type="submit" class="btn btn-success btn-block">ذخیره اطلاعات</button>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="seperate"></div>
@endsection
@push('script')


@endpush