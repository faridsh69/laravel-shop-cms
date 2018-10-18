@extends('admin.dashboard')
@section('title', 'دسته بندی ها')
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
        <a href="/admin/manage/category/create" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد دسته بندی جدید</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				دسته بندیها
			</div>
			<div class="half-seperate"></div>
			<div class="col-xs-12">
				<!-- <form class="form-inline" method="GET">
				  	<div class="form-group">
				    	<label for="name">عنوان یا توضیحات:</label>
				   	 	<input type="text" class="form-control input-sm" id="name" name="name" value="{{ 
				   	 	Request::input('name') }}">
				  	</div>
				  	<div class="form-group">
				    	<label for="type">نوع: </label>
				    	<select class="form-control" name="type">
							<option value="">همه</option>
							@foreach($types as $type)
								<option value="{{ $type }}"
								{{ Request::input('type') == $type ? "selected" : ""}} > 
									{{ $type }}
								</option>
							@endforeach
						</select>
				  	</div>
				  	<button type="submit" class="btn btn-default">جستجو</button>
			    	<span class="margin-right-10">
			    		{{ $categories->total() }} مورد یافت شد.
			    	</span>
				</form> -->
	        </div>

			<ul class="nav nav-tabs">
			    <li class="active"><a data-toggle="tab" href="#محصول">محصولات</a></li>
			    <li><a data-toggle="tab" href="#آگهی">آگهی ها</a></li>
			    <li><a data-toggle="tab" href="#انجمن">انجمن</a></li>
			    <li><a data-toggle="tab" href="#صفحه">صفحات</a></li>
			    <li><a data-toggle="tab" href="#مقاله">مقالات</a></li>
			    <li><a data-toggle="tab" href="#خبر">اخبار</a></li>
			</ul>

			<div class="tab-content">
				@each('admin.manage.category.table', $category_types, 'categories')
            </div>
            <hr>
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

