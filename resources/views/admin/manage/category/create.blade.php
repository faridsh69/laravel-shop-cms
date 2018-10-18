@extends('admin.dashboard')
@section('title', 'دسته بندی ها')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<a href="/admin/manage/category/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست دسته بندی ها</a>
        <div class="half-seperate"></div>
		@if(isset($category) )
		<form enctype="multipart/form-data" method="post" action="/admin/manage/category/{{$category->id}}" id="form">
			{{ method_field('PUT') }}
		@else
		<form enctype="multipart/form-data" method="post" action="/admin/manage/category" id="form">
		@endif
			{{ csrf_field() }}
			<div class="panel {{ Request::segment(4) == 'edit' ? 'panel-info' :'panel-success'}} panel-default">
				<div class="panel-heading">
					@if(Request::segment(4) == 'edit')
						ویرایش دسته بندی شماره: 
						{{ $category->id }}
						-
						{{ $category->title }}
					@else
						ایجاد دسته بندی جدید
					@endif
					@if( isset($category) )
						<input type="hidden" name="id" value="{{ $category->id }}">
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
							<td colspan="2">
								<button type="submit" class="btn btn-success btn-block">ذخیره اطلاعات</button>
							</td>
						</tr>
						</table>
							<category-field selected-type="{{ $category->type or null }}" selected-category-id="{{ isset($category->category) ? $category->category->id : null }}">
							</category-field>
						<table class="table table-striped">	
						<tr>
							<td class="width-120"><b>عنوان دسته بندی *</b></td>
							<td><input type="text" name="title" class="form-control"
							value="{{ $category->title or old('title') }}" required></td>
						</tr>
						<tr>
							<td>توضیحات</td>
							<td><textarea type="text" rows="2" name="description" class="form-control">{{ $category->description or old('description') }}</textarea></td>
						</tr>
						<tr>
							<td>وضعیت</td>
							<td>
								<select class="form-control" name="status">
								@foreach(\App\Models\Category::$STATUS as $key => $value)
									<option value='{{$key}}' 
									@if( isset($category) )
									{{ $category->status == $key ? 'selected' : '' }}
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
							value="{{ $category->meta_title or old('meta_title') }}">
						</tr>
						<tr>
							<td>توضیحات در موتورهای جستجو</td>
							<td><input type="text" name="meta_description" class="form-control"
							value="{{ $category->meta_description or old('meta_description') }}"></td>
						</tr>
						<tr>
							<td>آپلود عکس
								<div class="help-block">150*150پیکسل باشد.</div>
							</td>
							<td>
								<input id="file" type="file" accept='image/*' />
								<div class="half-seperate"></div>
								<button id="cropbutton" type="button" class="btn btn-info btn-xs">برش عکس</button>
								<button id="rotatebutton" type="button" class="btn btn-info btn-xs">چرخش</button>
								<div class="half-seperate"></div>
								<div id="views"></div>
								<div class="text-center">
									<img id='preview' class="img-responsive img-thumbnail">
									@if(isset($category))
										@if($category->image)
											<img src="{{$category->image->src100 }}" class="img-responsive">
											<a href="/admin/delete-image/{{$category->image->id}}" class="btn btn-xs btn-danger pull-right">جذف <i class="fa fa-remove"></i> </a>
										@else
										@endif
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
								<button type="submit" class="btn btn-success btn-block">ذخیره اطلاعات</button>
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