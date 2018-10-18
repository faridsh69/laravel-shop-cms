@extends('layout.master')
@section('title', 'مقالات')
@section('description', 'مقالات' )
@section('image', $constant['logo'])
@section('container')
<div class="row">
	<div class="col-xs-12">
		<h2 class="page-header text-center">
			مقالات
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
@foreach($articles as $article)
    <div class="col-xs-12 col-sm-6 col-md-4">
    	<div class="cart text-center">
    		<img src="{{ $article->image ? $article->image->src : '/upload/images/default.png'}}" class="cart-image">
    		<div class="half-seperate"></div>
    		<div class="text-right bold">
	    		{!! $article->top_title ? $article->top_title.'<br>' : '' !!}
	    		{!! $article->sub_title ? $article->sub_title.'<br>' : '' !!}
	    		{!! $article->title ? $article->title.'<br>' : '' !!}
    		</div>
            <p class="show-3line">
            	{!! $article->content !!}
            </p>
            <div class="half-seperate"></div>
            <a href="/content/article/{{ $article->id }}" class="pull-left">ادامه مطلب <span class="glyphicon glyphicon-arrow-left"></span></a>
        </div>
    </div>
@endforeach
</div>
<div class="text-center">
{{ $articles->links() }}
</div>
<div class="seperate"></div>
@endsection