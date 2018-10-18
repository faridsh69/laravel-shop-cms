@extends('layout.master')
@section('title', 'صفحات')
@section('description', 'صفحات' )
@section('image', $constant['logo'])
@section('container')
<div class="row">
	<div class="col-xs-12">
		<h2 class="page-header text-center">
			صفحات
		</h2>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<form class="form-inline" method="GET">
		  	<div class="form-group">
		    	<label for="name">عنوان یا متن:</label>
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
		</form>
	</div>
</div>
<hr>
<div class="seperate"></div>

<div class="row">
@foreach($pages as $page)
    <div class="col-xs-12 col-sm-6 col-md-4">
    	<div class="cart text-center">
    		<img src="{{ $page->image ? $page->image->src : '/upload/images/default.png'}}" class="cart-image">
    		<div class="half-seperate"></div>
    		<div class="text-right bold">
	    		{!! $page->top_title ? $page->top_title.'<br>' : '' !!}
	    		{!! $page->sub_title ? $page->sub_title.'<br>' : '' !!}
	    		{!! $page->title ? $page->title.'<br>' : '' !!}
    		</div>
            <p class="show-3line">
            	{!! $page->content !!}
            </p>
            <div class="half-seperate"></div>
            <a href="/content/page/{{ $page->id }}" class="pull-left">ادامه مطلب <span class="glyphicon glyphicon-arrow-left"></span></a>
        </div>
    </div>
@endforeach
</div>
<div class="text-center">
{{ $pages->links() }}
</div>
<div class="seperate"></div>
@endsection