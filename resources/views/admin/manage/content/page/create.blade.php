@extends('admin.dashboard')
@section('title', 'صفحات')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<a href="/admin/manage/content/page/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست صفحات</a>
        <div class="half-seperate"></div>
		@if(isset($page) )
		<form enctype="multipart/form-data" method="post" action="/admin/manage/content/page/{{$page->id}}" id="form">
			{{ method_field('PUT') }}
		@else
		<form enctype="multipart/form-data" method="post" action="/admin/manage/content/page" id="form">
		@endif
			{{ csrf_field() }}
			<div class="panel {{ Request::segment(4) == 'edit' ? 'panel-info' :'panel-success'}} panel-default">
				<div class="panel-heading">
					@if(Request::segment(4) == 'edit')
						ویرایش صفحه شماره: 
						{{ $page->id }}
						-
						{{ $page->title }}
					@else
						ایجاد صفحه جدید
					@endif
					@if( isset($page) )
						<input type="hidden" name="id" value="{{ $page->id }}">
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
							<td class="width-120"><b>عنوان صفحه *</b></td>
							<td><input type="text" name="title" class="form-control"
							value="{{ $page->title or old('title') }}" required></td>
						</tr>
						<tr>
							<td><b>متن صفحه *</b></td>
							<td><textarea class="ckeditor" name="content">{{ $page->content or old('content') }}</textarea></td>
						</tr>
						<tr>
							<td>دسته بندی</td>
							<td>
							<select class="form-control" name="category_id">
								<option value="">ندارد</option>
								@foreach($categories as $category)
									<option value="{{ $category->id }}"
									{{ ( isset($page) ? $page->category_id : 1 ) == $category->id ? "selected" : ""}} > 
										{{ $category->title }}
									</option>
								@endforeach
							</select>
							</td>
						</tr>
						<tr>
							<td>عنوان در موتورهای جستجو</div></td>
							<td><input type="text" name="meta_title" class="form-control"
							value="{{ $page->meta_title or old('meta_title') }}">
						</tr>
						<tr>
							<td>توضیحات در موتورهای جستجو</div></td>
							<td><input type="text" name="meta_description" class="form-control"
							value="{{ $page->meta_description or old('meta_description') }}"></td>
						</tr>
						
						<tr>
							<td>آپلود عکس 
							<div class="help-block">حجم تصویر حداکثر 1 مگابایت باشد.</div>
							</td>
							<td>
								<input id="file" type="file" accept='image/*' />
								<div class="half-seperate"></div>
								<div class="half-seperate"></div>
								<div id="views"></div>
								<div class="text-center">
								<img id='preview' class="img-responsive img-thumbnail">
								@if(isset($page))
									عکس سابق
									@if($page->image_id)
										<img src="{{$page->image->src100}}" class="img-responsive">
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
@push('script')


@endpush