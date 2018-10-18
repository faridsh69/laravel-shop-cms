@extends('admin.dashboard')
@section('title', 'آگهی ها')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<a href="{{ url('/admin/manage/advertise/index') }}" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست آگهی ها</a>
        <div class="half-seperate"></div>
        @if(isset($advertise) )
		<form enctype="multipart/form-data" method="post" action="/admin/manage/advertise/{{$advertise->id}}" id="form">
			{{ method_field('PUT') }}
		@else
		<form enctype="multipart/form-data" method="post" action="/admin/manage/advertise" id="form">
		@endif
			{{ csrf_field() }}
			<div class="panel {{ Request::segment(4) == 'edit' ? 'panel-info' :'panel-success'}} panel-default">
				<div class="panel-heading">
					@if(Request::segment(5) == 'edit')
						ویرایش آگهی شماره: 
						{{ $advertise->id }}
						-
						{{ $advertise->title }}
					@else
						ایجاد آگهی جدید
					@endif
					@if( isset($advertise) )
						<input type="hidden" name="id" value="{{ $advertise->id }}">
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
							<td colspan="20">
							<div class="col-xs-12">
								<button type="submit" class="btn btn-success btn-block">ذخیره اطلاعات</button>
								</div>
							</td>
						</tr>
						<tr>
							<td width="150px"><b>عنوان آگهی *</b></div></td>
							<td><input type="text" name="title" class="form-control"
							value="{{ $advertise->title or old('title') }}" required></td>
						</tr>
						<tr>
							<td><b>توضیح آگهی *</b></td>
							<td><textarea type="text" rows="3" name="description" class="form-control" 
							>{{ $advertise->description or old('description') }}</textarea></td>
						</tr>
						</table>
						<advertise-field 
						:id="@if( isset($advertise) ){{$advertise->id}}@else{{0}}@endif"></advertise-field>
						<table class="table table-striped">	
						<tr>
							<td width="150px">شماره تماس</td>
							<td><input type="text" name="phone" class="form-control"
							value="{{ $advertise->phone or old('phone') }}" required></td>
						</tr>
						<tr>
							<td>آدرس</td>
							<td><input type="text" name="address" class="form-control"
							value="{{ $advertise->address or old('address') }}"></td>
						</tr>
						
						<tr class="text-right">
							<td>موافقت با قوانین سایت</td>
							<td><input type="checkbox" name="aggrement" class="form-control" checked value="1" required></td>
						</tr>
						<tr>
							<td>دلیل رد شدن آگهی</td>
							<td>
								<select class="form-control" name="why_not_accept_text">
									<option value="">یک گزینه را انتخاب نمایید.</option>
									@foreach( explode('+', \App\Models\Setting::where('key', 'advertise_why_not_accept_status')->first()->value) as $key => $value)
									<option value="{{ $value }}"
									@if( isset($advertise) )
									{{ $advertise->why_not_accept_text == $value  ? "selected" : ""}} 
									@endif
									> 
										{{ $value }}
									</option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td>آپلود عکس 
							<small class="help-block">تصویری با طول و عرض برابر وارد کنید.<br> حداقل کیفیت 400 در 400 پیکسل باشد.</small>
							</td>
							<td>
								<input id="file" type="file" accept='image/*'  
									name="" />
								<div class="half-seperate"></div>
								<button id="cropbutton" type="button" class="btn btn-info btn-xs">
										برش عکس
								</button>
								<button id="uploadImageAdvertise" type="button" class="farid btn btn-info btn-xs">
									<i class="fa fa-1x fa-upload"></i>
									آپلود عکس
								</button>
								<div class="half-seperate"></div>
								<div id="views"></div>
								<div class="text-center">
								<img id='preview' class="img-responsive img-thumbnail">
								</div>
							</td>		
						</tr>
						<tr>
							<td>گالری عکس ها
								<div class="alert alert-success" id="upload-success">
									عکس با موفقیت ذخیره شد
								</div>
								<div class="alert alert-danger" id="upload-error">
									عکس آپلود نشد
								</div>
							</td>
							<td id="gallery">
								@if(isset($advertise))
									@if($advertise->images)
										@foreach($advertise->images as $image)
										<div class="col-sm-3 text-center">
											<img src="{{ $image->src100 }}" class="img-thumbnail  img-responsive">
											<a href="/admin/delete-image/{{$image->id}}" class="btn btn-xs btn-danger">جذف <i class="fa fa-remove"></i> </a>
										</div>
										@endforeach
										<div>(حذف عکس یک آیتم در گروه باعث حذف این عکس در سایر گروه ها می شود)</div>
									@else
									<div class="seperate"></div>
									<div class="text-center">
										تصویر آپلود نشده است!
									</div>
									@endif
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