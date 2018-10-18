@extends('admin.dashboard')
@section('title', 'صفحات')
@section('content')
<div class="row">
	<div class="col-xs-12">
        <a href="/admin/manage/content/page/create" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد صفحه جدید</a>
    	<a href="/admin/manage/content/page/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست صفحات</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				صفحه شماره {{ $page->id }}
				<a href="/admin/manage/content/page/{{$page->id}}/edit" class="btn btn-info btn-xs">
        			<span class="glyphicon glyphicon-pencil"></span>ویرایش</a>
        		<form action="/admin/manage/content/page/{{ $page->id }}" method="POST" class="display-inline">
				    {{ method_field('DELETE') }}
				    {{ csrf_field() }}
					<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> حذف</button>
				</form>
			</div>
			<div class="panel-boddy">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<div class="seperate"></div>
						@if($page->image_id)
						<img src="{{ $page->image->src }}" class="img-responsive">
						@else
						<div class="seperate"></div>
						<div class="text-center">
						تصویر آپلود نشده است!
						</div>
						@endif
						<div class="half-seperate"></div>
						<div class="bold">
							سرتیتر: 
							{{ $page->top_title }}
							<div class="one-third-seperate"></div>
							عنوان: 
							{{ $page->title }}
							<div class="one-third-seperate"></div>
							زیر عنوان:
							{{ $page->sub_title }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>دسته بندی:</label>
							{{ $page->category ? $page->category->title : 'ندارد'}}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>وضعیت:</label>
							{{ $page->status_translate() }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>نویسنده:</label>
							{{ $page->user ? $page->user->first_name : ''}}
							{{ $page->user ? $page->user->last_name : ''}}
							-
							آیدی کاربری:
							{{ $page->user ? $page->user->id : '-'}}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>عنوان در موتورهای جست جو:</label>
							{{ $page->meta_title ? $page->meta_title : $page->title }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>توضیحات در موتورهای جست جو:</label>
							{{ $page->meta_description }}
						</div>
						<div class="half-seperate"></div>
						تاریخ آخرین تغییر:
						<br>
						{{ \Nopaad\jDate::forge( $page->updated_at )->format(' %Y/%m/%d') }}
						<br>
						{{ \Nopaad\jDate::forge( $page->updated_at )->format(' %H:%M:%S') }}
						<hr>
						<div>
							<label>متن صفحه:</label>
							{{ $page->content}}
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