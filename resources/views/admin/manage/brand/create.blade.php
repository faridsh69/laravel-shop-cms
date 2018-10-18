@extends('admin.dashboard')
@section('title', 'برند ها')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<a href="{{ route('brand.index') }}" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست برندها</a>
        <div class="half-seperate"></div>
		 @if(isset($brand) )
		<form enctype="multipart/form-data" method="post" action="{{ route('brand.update', ['brand' => $brand]) }}" id="form">
			{{ method_field('PUT') }}
		@else
		<form enctype="multipart/form-data" method="post" action="{{ route('brand.index') }}" id="form">
		@endif
			{{ csrf_field() }}
			<div class="panel {{ Request::segment(4) == 'edit' ? 'panel-info' :'panel-success'}} panel-default">
				<div class="panel-heading">
					@if(Request::segment(4) == 'edit')
						ویرایش برند شماره: 
						{{ $brand->id }}
						-
						{{ $brand->title }}
					@else
						ایجاد برند جدید
					@endif
					@if( isset($brand) )
						<input type="hidden" name="id" value="{{ $brand->id }}">
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
							<td class="width-120"><b>عنوان برند *</b></td>
							<td><input type="text" name="title" class="form-control"
							value="{{ $brand->title or old('title') }}" required></td>
						</tr>
						<tr>
							<td>توضیح برند</td>
							<td>
								<textarea class="ckeditor" name="description">{{ $brand->description or old('description') }}</textarea>
							</td>
						</tr>
						<tr>
							<td>وضعیت</td>
							<td>
								<select class="form-control" name="status">
								@foreach(\App\Models\Brand::$STATUS as $key => $value)
									<option value='{{$key}}' 
									@if( isset($brand) )
									{{ $brand->status == $key ? 'selected' : '' }}
									@else
									{{ old('status') == $key ? 'selected' : '' }}
									@endif
									> {{$value}} </option> 
								@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td>عنوان در موتورهای جستجو</td>
							<td><input type="text" name="meta_title" class="form-control"
							value="{{ $brand->meta_title or old('meta_title') }}">
						</tr>
						<tr>
							<td>توضیحات در موتورهای جستجو</td>
							<td><input type="text" name="meta_description" class="form-control"
							value="{{ $brand->meta_description or old('meta_description') }}"></td>
						</tr>
						<tr>
							<td>آپلود عکس 
							<div class="help-block">150*150 پیکسل.</div>
							</td>
							<td>
								<input id="file" type="file" accept='image/*' />
								<div class="half-seperate"></div>
								<button id="cropbutton" type="button" class="btn btn-info btn-xs">
									برش عکس
								</button>
								<div class="half-seperate"></div>
								<div id="views"></div>
								<div class="text-center">
								<img id='preview' class="img-responsive img-thumbnail">
								@if(isset($brand))
									@if($brand->image)
										<img src="{{$brand->image->src100 }}" class="img-responsive">
										<a href="/admin/delete-image/{{$brand->image->id}}" class="btn btn-xs btn-danger pull-right">حذف <i class="fa fa-remove"></i> 
										</a>
									@else
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
@push('script')
<script src="{{ asset('js/ckeditor4/ckeditor.js') }}"></script>
@endpush