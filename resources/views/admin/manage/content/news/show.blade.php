@extends('admin.dashboard')
@section('title', 'اخبار')
@section('content')
<div class="row">
	<div class="col-xs-12">
        <a href="/admin/manage/content/news/create" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد خبر جدید</a>
    	<a href="/admin/manage/content/news/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست اخبار</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				خبر شماره {{ $news->id }}
				<a href="/admin/manage/content/news/{{$news->id}}/edit" class="btn btn-info btn-xs">
        			<span class="glyphicon glyphicon-pencil"></span>ویرایش</a>
        		<form action="/admin/manage/content/news/{{ $news->id }}" method="POST" class="display-inline">
				    {{ method_field('DELETE') }}
				    {{ csrf_field() }}
					<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> حذف</button>
				</form>
			</div>
			<div class="panel-boddy">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<div class="seperate"></div>
						@if($news->image_id)
						<img src="{{ $news->image->src }}" class="img-responsive">
						@else
						<div class="seperate"></div>
						<div class="text-center">
						تصویر آپلود نشده است!
						</div>
						@endif
						<div class="half-seperate"></div>
						<div class="bold">
							<div class="one-third-seperate"></div>
							عنوان: 
							{{ $news->title }}
							<div class="one-third-seperate"></div>
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>دسته بندی:</label>
							{{ $news->category ? $news->category->title : 'ندارد'}}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>وضعیت:</label>
							{{ $news->status_translate() }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>نویسنده:</label>
							{{ $news->user ? $news->user->first_name : ''}}
							{{ $news->user ? $news->user->last_name : ''}}
							-
							آیدی کاربری:
							{{ $news->user ? $news->user->id : '-'}}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>عنوان در موتورهای جست جو:</label>
							{{ $news->meta_title ? $news->meta_title : $news->title }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>توضیحات در موتورهای جست جو:</label>
							{{ $news->meta_description }}
						</div>
						<div class="half-seperate"></div>
						تاریخ آخرین تغییر:
						<br>
						{{ \Nopaad\jDate::forge( $news->updated_at )->format(' %Y/%m/%d') }}
						<br>
						{{ \Nopaad\jDate::forge( $news->updated_at )->format(' %H:%M:%S') }}
						<hr>
						<div>
							<label>متن خبر:</label>
							{!! $news->content !!}
						</div>
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