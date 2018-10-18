@extends('layout.master')
@section('title', 'پرسش و پاسخ')
@section('description', 'پرسش و پاسخ' )
@section('image', $constant['logo'])
@section('container')
<div class="row">
	<div class="col-xs-12">
		<h2 class="page-header text-center">
			پرسش و پاسخ
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
@foreach($forums as $forum)
	@if($forum->status == 1 || \Gate::allows('forum_manager') )
	<div class="row">
	    <div class="col-xs-12">
	    	<div class="forum-card">
		        <div class="media">
		            <div class="media-left">
		            	<img src="{{ $forum->user->base_image() }}" alt="{{ $forum->user->last_name }}" class="media-object width-80px">
		            </div>
		            <div class="media-body">
		                <h4 class="media-heading">
		                	<span class="glyphicon glyphicon-user"></span>
		                	{{ $forum->user->first_name }}
		                	{{ $forum->user->last_name }}
		                	<small>
		                	-
		                	<span class="glyphicon glyphicon-time"></span>
		                	{{ \Nopaad\jDate::forge( $forum->updated_at )->format(' %Y/%m/%d') }} - 
							{{ \Nopaad\jDate::forge( $forum->updated_at )->format(' %H:%M:%S') }}
							</small>
							<div class="pull-left small">
								بازدید: {{ $forum->views_count_all() }}
								بار
								<div class="half-seperate"></div>
								تعداد پاسخ ها: 
								{{ $forum->answers_count() }}
								@can('forum_manager')
								<div class="half-seperate"></div>
								<select class="form-control width-120px" 
								onchange="statusChanged(this, {{ $forum->id }}, 'forum')">
									@foreach(\App\Models\Forum::$STATUS as $key => $value)
									<option value='{{$key}}' {{ $forum->status == $key ? 'selected' : '' }}> {{$value}} </option> 
									@endforeach
								</select>
								@endcan
							</div>

							
		            	</h4>
		                <h5>
		                    <span class="glyphicon glyphicon-comment"></span>
		                    <a href="/forum/{{$forum->id}}" class="black-color">
		                    	{{$forum->title}}
		                    </a>
		                </h5>
		                <h6>
		                    <span class=""></span>
		                    {{$forum->content}}
		                </h6>
		                <p>
		                	<a href="/admin/forum/{{ $forum->id }}"><span class="glyphicon glyphicon-share-alt"></span> پاسخ دادن</a>
		                </p>
		                <div class="seperate"></div>
		               
		            </div>
		        </div>
	        </div>
	    </div>
	</div>
	@endif
@endforeach
<div class="text-center">
{{ $forums->links() }}
</div>
<div class="seperate"></div>
<h4>
	ایجاد پست جدید: <small> (پرسش خود را اینجا می توانید مطرح نمایید)</small>
</h4>
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<form enctype="multipart/form-data" method="post" action="/admin/forum" id="form"
			class="form-horizontal">
			{{ csrf_field() }}
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
            <div class="form-group">
		    	<label class="control-label col-sm-2" for="title">عنوان پرسش:</label>
		    	<div class="col-sm-10">
		      		<input type="text" name="title" class="form-control" id="title">
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label class="control-label col-sm-2" for="pwd">دسته بندی پرسش:</label>
		    	<div class="col-sm-10"> 
		      		<select class="form-control" name="category_id">
						<option value="">ندارد</option>
						@foreach($categories as $category)
							<option value="{{ $category->id }}">
								{{ $category->title }}
							</option>
						@endforeach
					</select>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label class="control-label col-sm-2" for="pwd">متن پرسش:</label>
		    	<div class="col-sm-10"> 
		      		<textarea type="text" rows="4" name="content" class="form-control" required="" 
					>{{ old('content') }}</textarea>
		    	</div>
		  	</div>
		  	<div class="form-group">
			  	<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-success btn-block">ارسال</button>
				</div>
			</div>
			<input type="hidden" name="forum_id" value="">
		</form>
	</div> 
</div>


@endsection
@push('script')
<script src="{{ asset('js/sort.js') }}"></script>
@endpush