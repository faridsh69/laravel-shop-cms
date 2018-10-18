@extends('admin.dashboard')
@section('title', 'مقالات')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<a href="/admin/manage/content/article/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست مقالات</a>
        <div class="half-seperate"></div>
		@if(isset($article) )
		<form enctype="multipart/form-data" method="post" action="/admin/manage/content/article/{{$article->id}}" id="form">
			{{ method_field('PUT') }}
		@else
		<form enctype="multipart/form-data" method="post" action="/admin/manage/content/article" id="form">
		@endif
			{{ csrf_field() }}
			<div class="panel {{ Request::segment(4) == 'edit' ? 'panel-info' :'panel-success'}} panel-default">
				<div class="panel-heading">
					@if(Request::segment(4) == 'edit')
						ویرایش مقاله شماره: 
						{{ $article->id }}
						-
						{{ $article->title }}
					@else
						ایجاد مقاله جدید
					@endif
					@if( isset($article) )
						<input type="hidden" name="id" value="{{ $article->id }}">
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
							<td><b>عنوان مقاله *</b></div></td>
							<td><input type="text" name="title" class="form-control"
							value="{{ $article->title or old('title') }}" required></td>
						</tr>
						<tr>
							<td><b>متن مقاله *</b></td>
							<td><textarea class="ckeditor" name="content">{{ $article->content or old('content') }}</textarea></td>
						</tr>
						<tr>
							<td>دسته بندی</td>
							<td>
							<select class="form-control" name="category_id">
								<option value="">ندارد</option>
								@foreach($categories as $category)
									<option value="{{ $category->id }}"
									{{ ( isset($article) ? $article->category_id : 1 ) == $category->id ? "selected" : ""}} > 
										{{ $category->title }}
									</option>
								@endforeach
							</select>
							</td>
						</tr>
						<tr>
							<td class="width-120">عنوان در موتورهای جستجو</div></td>
							<td><input type="text" name="meta_title" class="form-control"
							value="{{ $article->meta_title or old('meta_title') }}">
						</tr>
						<tr>
							<td>توضیحات در موتورهای جستجو</div></td>
							<td><input type="text" name="meta_description" class="form-control"
							value="{{ $article->meta_description or old('meta_description') }}"></td>
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
								@if(isset($article))
									عکس سابق
									@if($article->image_id)
										<img src="{{$article->image->src100 }}" class="img-responsive">
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