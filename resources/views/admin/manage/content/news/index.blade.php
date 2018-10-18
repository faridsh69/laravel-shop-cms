@extends('admin.dashboard')
@section('title', 'اخبار')
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
        <a href="/admin/manage/content/news/create" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد خبر جدید</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				اخبار
			</div>
			<div class="half-seperate"></div>
			<div class="col-xs-12">
				<form class="form-inline" method="GET">
				  	<div class="form-group">
				    	<label for="name">عنوان یا محتوا:</label>
				   	 	<input type="text" class="form-control input-sm" id="name" name="name" value="{{ 
				   	 	Request::input('name') }}">
				  	</div>
				  	<div class="form-group">
				    	<label for="category">دسته بندی: </label>
				    	<select class="form-control" name="category">
							<option value="">همه</option>
							@foreach($categories as $category)
								<option value="{{ $category->id }}"
								{{ Request::input('category') == $category->id ? "selected" : ""}} > 
									{{ $category->title }}
								</option>
							@endforeach
						</select>
				  	</div>
				  	<button type="submit" class="btn btn-default">جستجو</button>
				  	<!-- <div class="form-group"> -->
				    	<span class="margin-right-10">
				    		{{ $newses->total() }} مورد یافت شد.
				    	</span>
				    <!-- </div> -->
				  	
				</form>
	        </div>
			<div class="reponsive-table">
				<table class="table table-striped">
				<thead>
				<tr>
					<th>
						@if(Request::input('sort') == 'id')
							@if(Request::input('order') == 'asc')
								<a href="{{url()->current()}}?name={{Request::input('name')}}&category={{Request::input('category')}}&sort=id&order=desc" class="inline-flex"> شمارنده <span class="glyphicon glyphicon-chevron-down"></span></a>
							@else
								<a href="{{url()->current()}}?name={{Request::input('name')}}&category={{Request::input('category')}}&sort=id&order=asc" class="inline-flex"> شمارنده <span class="glyphicon glyphicon-chevron-up"></span></a>
							@endif
						@else
							<a href="{{url()->current()}}?name={{Request::input('name')}}&category={{Request::input('category')}}&sort=id&order=asc"> شمارنده </a>
						@endif
					</th>
					<th>
						@if(Request::input('sort') == 'title')
							@if(Request::input('order') == 'asc')
								<a href="{{url()->current()}}?name={{Request::input('name')}}&category={{Request::input('category')}}&sort=title&order=desc" class="inline-flex"> عنوان <span class="glyphicon glyphicon-chevron-down"></span></a>
							@else
								<a href="{{url()->current()}}?name={{Request::input('name')}}&category={{Request::input('category')}}&sort=title&order=asc" class="inline-flex"> عنوان <span class="glyphicon glyphicon-chevron-up"></span></a>
							@endif
						@else
							<a href="{{url()->current()}}?name={{Request::input('name')}}&category={{Request::input('category')}}&sort=title&order=asc"> عنوان</a>
						@endif
					</th>
					<th>
						محتوا
					</th>
					<th class="hidden-xs">
						دسته بندی
					</th>
					<th class="hidden-xs">
						نویسنده
					</th>
					<th>
						تصویر
					</th>
					<th>
						وضعیت
					</th>
					<th>
						عملیات
					</th>
				</tr>
				</thead>
				<tbody>
					@if( count($newses) == 0 )
					<tr>
						<td colspan="10">
							<div class="alert">
								موردی یافت نشد !
							</div>
						</td>
					</tr>
					@endif
					@foreach($newses as $news)
					<tr>
						<td class="text-center width-50px">
							{{ $news->id }}
						</td>
						<td>
							{{ $news->title}}
						</td>
						<td class="description-div">
							{{ $news->content}}
						</td>
						<td class="hidden-xs">
							{{ $news->category ? $news->category->title : 'ندارد'}}
						</td>
						<td class="hidden-xs">
							{{ $news->user ? $news->user->first_name : ''}}
							{{ $news->user ? $news->user->last_name : ''}}
						</td>
						<td class="width-20%">
							@if($news->image)
								<img src="{{ $news->image->src100 }}" class="img-responsive img-thumbnail image-table">
							@else
								تصویر ندارد
							@endif
						</td>
						<td>
							{{ $news->status_translate() }}
						</td>
						<td class="width-80px">
							<a href="/admin/manage/content/news/{{ $news->id }}">
								<span class="glyphicon glyphicon-eye-open"></span>
								مشاهده
							</a>
							<div class="one-third-seperate"></div>
							<a href="/admin/manage/content/news/{{ $news->id }}/edit">
								<span class="glyphicon glyphicon-pencil"></span>
								ویرایش
							</a>
							<div class="one-third-seperate"></div>
							<form action="/admin/manage/content/news/{{ $news->id }}" method="POST" class="display-inline">
							    {{ method_field('DELETE') }}
							    {{ csrf_field() }}
								<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> حذف</button>
							</form>
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
			{{ $newses->links() }}
		</div>
	</div>
</div>
@endsection
@push('script')




<script type="text/javascript">
	@if($query)
		var query = '{{ $query }}';
	@endif
</script>
<script src="{{ asset('js/sort.js') }}"></script>
@endpush