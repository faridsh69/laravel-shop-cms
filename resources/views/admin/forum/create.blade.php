@extends('admin.dashboard')
@section('title', 'انجمن')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<a href="/admin/forum/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست پرسش و پاسخها</a>
        <div class="half-seperate"></div>
        @if(isset($forum) )
		<form enctype="multipart/form-data" method="post" action="/admin/forum/{{$forum->id}}" id="form">
			{{ method_field('PUT') }}
		@else
		<form enctype="multipart/form-data" method="post" action="/admin/forum" id="form">
		@endif
			{{ csrf_field() }}
			<div class="panel {{ Request::segment(4) == 'edit' ? 'panel-info' :'panel-success'}} panel-default">
				<div class="panel-heading">
					@if(Request::segment(4) == 'edit')
						ویرایش پرسش و پاسخ شماره: 
						{{ $forum->id }}
						-
						{{ $forum->title }}
					@else
						ایجاد پرسش و پاسخ جدید
					@endif
					@if( isset($forum) )
						<input type="hidden" name="id" value="{{ $forum->id }}">
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
							<td width="190px"><b>عنوان پرسش و پاسخ *</b></div></td>
							<td><input type="text" name="title" class="form-control"
							value="{{ $forum->title or old('title') }}" required></td>
						</tr>
						<tr>
							<td><b>متن پرسش و پاسخ *</b></td>
							<td><textarea type="text" rows="4" name="content" class="form-control" required="" 
							>{{ $forum->content or old('content') }}</textarea></td>
						</tr>
						<tr>
							<td>دسته بندی</td>
							<td>
							<select class="form-control" name="category_id">
								<option value="">ندارد</option>
								@foreach($categories as $category)
									<option value="{{ $category->id }}"
									{{ ( isset($forum) ? $forum->category_id : 1 ) == $category->id ? "selected" : ""}} >
										{{ $category->title }}
									</option>
								@endforeach
							</select>
							</td>
						</tr>
						<tr>
							<td>پرسش/پاسخ</td>
							<td>
							<select class="form-control" name="forum_id">
								<option value="">پرسش است.</option>
								@foreach($question_forums as $question_forum)
									<option value="{{ $question_forum->id }}"
									{{ ( isset($forum) ? $forum->forum_id : 0 ) == $question_forum->id ? "selected" : ""}} > 
										{{ $question_forum->title }}
									</option>
								@endforeach
							</select>
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