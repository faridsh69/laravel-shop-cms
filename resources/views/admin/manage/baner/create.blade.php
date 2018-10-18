@extends('admin.dashboard')
@section('title', 'بنر ها')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<a href="/admin/manage/baner/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست بنرها</a>
        <div class="half-seperate"></div>
		 @if(isset($baner) )
		<form enctype="multipart/form-data" method="post" action="/admin/manage/baner/{{$baner->id}}" id="form">
			{{ method_field('PUT') }}
		@else
		<form enctype="multipart/form-data" method="post" action="/admin/manage/baner" id="form">
		@endif
			{{ csrf_field() }}
			<div class="panel {{ Request::segment(4) == 'edit' ? 'panel-info' :'panel-success'}} panel-default">
				<div class="panel-heading">
					@if(Request::segment(4) == 'edit')
						ویرایش بنر شماره: 
						{{ $baner->id }}
						-
						{{ $baner->title }}
					@else
						ایجاد بنر جدید
					@endif
					@if( isset($baner) )
						<input type="hidden" name="id" value="{{ $baner->id }}">
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
							<td class="width-120"><b>عنوان بنر *</b></td>
							<td><input type="text" name="title" class="form-control"
							value="{{ $baner->title or old('title') }}" required></td>
						</tr>
						<tr>
							<td>توضیح بنر</td>
							<td><textarea class="ckeditor" name="description">{{ $baner->description or old('description') }}</textarea></td>
						</tr>
						<tr>
							<td>آدرس کاربر زمانی که روی بنر کلیک می کند؟</td>
							<td><input type="text" name="url" class="form-control"
							value="{{ $baner->url or old('url') }}"></td>
						</tr>
						<tr>
							<td>موقعیت در صفحه</td>
							<td>
								<select class="form-control" name="location">
								@foreach(\App\Models\Baner::$LOCATION as $key => $value)
								<option value='{{$key}}' 
								@if(isset($baner) )
									{{ $baner->location == $key ? 'selected' : '' }}
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
							<div class="help-block">تصاویر هم سایز آپلود کنید و با کیفیت.</div>
							</td>
							<td>
								<input id="file" type="file" accept='image/*' />
								<div class="half-seperate"></div>
								<div class="half-seperate"></div>
								<div id="views"></div>
								<div class="text-center">
								<img id='preview' class="img-responsive img-thumbnail">
								@if(isset($baner))
									عکس سابق
									@if($baner->image_id)
										<img src="{{$baner->image->src100 }}" class="img-responsive">
									@else
										ندارد
									@endif
								@endif
								</div>
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