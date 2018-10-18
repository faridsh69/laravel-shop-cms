@extends('admin.dashboard')
@section('title', 'پروفایل کاربر')
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
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<form enctype="multipart/form-data" action="/admin/profile" method="POST" id="form">
			{{ csrf_field() }}
			<div class="panel panel-default">
				<div class="panel-heading">پروفایل کاربر</div>
	            <div class="table-responsive">
					<table class="table table-striped table-hover">
						<tr>
							<td class="width-120"> <b>نام *</b> </td>
							<td><input type="text" name="first_name" class="form-control"
							value="{{ old('first_name' , \Auth::user()->first_name) }}"></td>
						</tr>
						<tr>
							<td> <b>نام خانوادگی *</b> </td>
							<td><input type="text" name="last_name" class="form-control"
							value="{{ old('last_name' , \Auth::user()->last_name) }}"></td>
						</tr>
						<tr>
							<td> <b>تلفن همراه *<b> <div class="help-block">مثال: 09121112233</div></td>
							<td><input type="text" name="phone" class="form-control"
							value="{{ old('phone' , \Auth::user()->phone) }}"> </td>
						</tr>
						<tr>
							<td>ایمیل</td>
							<td><input type="email" name="email" class="form-control"
							value="{{ old('email' , \Auth::user()->email) }}"> </td>
						</tr>
						<tr>
							<td>آپلود عکس
								<div class="help-block">تصویر 150*150</div>
							</td>
							<td>
								<input id="file" type="file" accept='image/*' />
								<div class="half-seperate"></div>
								<button id="cropbutton" type="button" class="btn btn-info btn-xs">برش عکس</button>
								<button id="rotatebutton" type="button" class="btn btn-info btn-xs">چرخش</button>
<!-- 								<button id="hflipbutton" type="button" class="btn btn-info btn-xs">آینه افقی</button>
								<button id="vflipbutton" type="button" class="btn btn-info btn-xs">آینه عمودی</button>
 -->								<div class="half-seperate"></div>
								<div id="views"></div>
								<div class="text-center">
									<img id='preview' class="img-responsive img-thumbnail">
									@if(isset(\Auth::user()->avatar))
										عکس سابق
										<img src="{{ asset(\Auth::user()->base_image() ) }}"  class="img-responsive img-thumbnail">
									@endif
									<p>
										<span class="glyphicon glyphicon-camera"></span>
										<br/>
										پیش‌نمایش تصویر
									</p>
								</div>
							</td>
						</tr>
						
						<tr>
							<td colspan="2">
							<button type="submit" class="btn btn-success btn-block"> ذخیره تغییرات </button>
							</td>
						</tr>
					</table>			
	        	</div>
			</div>
		</form>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		@include('admin.profile.addresses')
		@include('admin.profile.create-address')
		@if(1==2)
			@include('admin.profile.charge-credit')
		@endif
		@include('admin.profile.change-password')
	</div>
</div>
<div class="seperate"></div>
@endsection
@push('script')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCaTGuyJD5pQKp9i2zkyhg5NJ76RH3vLlA&callback=initMap" type="text/javascript"></script>
<script src="{{ asset('/js/google-map-marker.js') }}"></script>
@endpush

