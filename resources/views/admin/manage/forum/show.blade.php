@extends('admin.dashboard')
@section('title', 'انجمن')
@section('content')
<div class="row">
	<div class="col-xs-12">
        <a href="/admin/manage/forum/create" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد پرسش و پاسخ جدید</a>
    	<a href="/admin/manage/forum/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست پرسش و پاسخها</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				پرسش و پاسخ شماره {{ $forum->id }}
				<a href="/admin/manage/forum/{{$forum->id}}/edit" class="btn btn-info btn-xs">
        			<span class="glyphicon glyphicon-pencil"></span>ویرایش</a>
        		<form action="/admin/manage/forum/{{ $forum->id }}" method="POST" class="display-inline">
				    {{ method_field('DELETE') }}
				    {{ csrf_field() }}
					<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> حذف</button>
				</form>
			</div>
			<div class="panel-boddy">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<div class="half-seperate"></div>
						<div class="bold">
							<div class="one-third-seperate"></div>
							عنوان: 
							{{ $forum->title }}
							<div class="one-third-seperate"></div>
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>پرسش/پاسخ :</label>
							@if($forum->forum)
								پاسخ به: {{ $forum->forum->title }} -
								<a href="/admin/manage/forum/{{ $forum->forum->id }}">لینک سوال</a>
							@else
								پرسش
							@endif
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>دسته بندی:</label>
							{{ $forum->category ? $forum->category->title : 'ندارد'}}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>وضعیت:</label>
							{{ $forum->status_translate() }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>نویسنده:</label>
							{{ $forum->user ? $forum->user->first_name : ''}}
							{{ $forum->user ? $forum->user->last_name : ''}}
							-
							آیدی کاربری:
							{{ $forum->user ? $forum->user->id : ''}}
						</div>
						<div class="half-seperate"></div>
						تاریخ آخرین تغییر:
						<br>
						{{ \Nopaad\jDate::forge( $forum->updated_at )->format(' %Y/%m/%d') }}
						<br>
						{{ \Nopaad\jDate::forge( $forum->updated_at )->format(' %H:%M:%S') }}
						<div class="seperate"></div>
							بازدید:
							{{ $forum->views->count() }}
							بار
						<hr>
						<div>
							<label><b>متن:</b></label>
							{{ $forum->content}}
						</div>
						@if(count($forum->forums) > 0)
							<hr>
							<h4>
							پاسخ ها:
							</h4>
							@foreach($forum->forums as $item)
							<div class="simple-box">
								<label><b> عنوان: </b></label>
								{{ $item->title}}
								<div class="half-seperate"></div>
								<a href="/admin/manage/forum/{{ $item->id }}">لینک پاسخ </a>
								<div class="half-seperate"></div>
								<label><b>متن:</b></label>
								{{ $item->content}}
							</div>
							<div class="seperate"></div>
							@endforeach
						@endif
						<div class="seperate"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('script')



@endpush