@extends('layout.master')
@section('title', 'پرسش و پاسخ')
@section('description', 'پرسش و پاسخ' )
@section('image', $constant['logo'])
@section('container')
<div class="row">
	<div class="col-xs-12">
		<h1 class="page-header text-center">
			{{$forum->title}}
		</h1>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
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
						
					</div>
            	</h4>
                <h5>
                    <span class="glyphicon glyphicon-comment"></span>
                    	{{$forum->title}}
                </h5>
                <h6>
                    <span class=""></span>
                    {{$forum->content}}
                </h6>
                <div class="seperate"></div>
            </div>
        </div>
	</div>
</div>
<hr>
<div class="big-size bold">
پاسخ ها:
</div>
@foreach($forum->forums as $answer)
	@if($answer->status == 1 || \Gate::allows('forum_manager') )
	<div class="row">
	    <div class="col-xs-10 col-xs-offset-1">
	    	
	    	<div class="forum-card">
		        <div class="media">
		            <div class="media-left">
		            	<img src="{{ $answer->user->base_image() }}" alt="{{ $answer->user->last_name }}" class="media-object width-80px">
		            </div>
		            <div class="media-body">
		                <h4 class="media-heading">
		                	<span class="glyphicon glyphicon-user"></span>
		                	{{ $answer->user->first_name }}
		                	{{ $answer->user->last_name }}
		                	<small>
		                	-
		                	<span class="glyphicon glyphicon-time"></span>
		                	{{ \Nopaad\jDate::forge( $answer->updated_at )->format(' %Y/%m/%d') }} - 
							{{ \Nopaad\jDate::forge( $answer->updated_at )->format(' %H:%M:%S') }}
							</small>

							<div class="pull-left">
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
	                    	{{$answer->title}}
		                </h5>
		                <h6>
		                    <span class=""></span>
		                    {{$answer->content}}
		                </h6>
		            </div>
		        </div>
	        </div>
	    </div>
	</div>
	@endif
@endforeach
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
		    	<label class="control-label col-sm-2" for="title">عنوان پاسخ:</label>
		    	<div class="col-sm-10">
		      		<input type="text" name="title" class="form-control" id="title">
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label class="control-label col-sm-2" for="pwd">متن پاسخ:</label>
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
			<input type="hidden" name="category_id" value="{{$forum->category_id}}">
			<input type="hidden" name="forum_id" value="{{$forum->id}}">
		</form>
	</div> 
</div>
<div class="seperate"></div>
@endsection
@push('script')
<script src="{{ asset('js/sort.js') }}"></script>
@endpush