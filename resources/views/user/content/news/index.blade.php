@extends('layout.master')
@section('title', 'اخبار')
@section('description', 'اخبار' )
@section('image', $constant['logo'])
@section('container')
<div class="row">
	<div class="col-xs-12">
		<h2 class="page-header text-center">
			اخبار
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
@foreach($newses as $news)
    <div class="col-xs-12 col-sm-6 col-md-4">
    	<div class="cart text-center">
    		<img src="{{ $news->image ? $news->image->src : '/upload/images/default.png'}}" class="cart-image">
    		<div class="half-seperate"></div>
    		<div class="show-3line text-right bold">
    			<a href="/content/news/{{ $news->id }}" class="">
	    		{!! $news->title !!}
	    		</a>
    		</div>
            <div class="show-3line height-80">
            	{!! $news->content !!}
            </div>
            <div class="half-seperate"></div>
            
        </div>
    </div>
@endforeach
</div>
<div class="text-center">
{{ $newses->links() }}
</div>
<div class="seperate"></div>
@endsection