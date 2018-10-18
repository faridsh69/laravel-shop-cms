@extends('admin.dashboard')
@section('title', 'مقالات')
@section('content')
<div class="row">
	<div class="col-xs-12">
        <a href="/admin/manage/content/article/create" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد مقاله جدید</a>
    	<a href="/admin/manage/content/article/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست مقالات</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				مقاله شماره {{ $article->id }}
				<a href="/admin/manage/content/article/{{$article->id}}/edit" class="btn btn-info btn-xs">
        			<span class="glyphicon glyphicon-pencil"></span>ویرایش</a>
        		<form action="/admin/manage/content/article/{{ $article->id }}" method="POST" class="display-inline">
				    {{ method_field('DELETE') }}
				    {{ csrf_field() }}
					<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> حذف</button>
				</form>
			</div>
			<div class="panel-boddy">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<div class="seperate"></div>
						@if($article->image_id)
						<img src="{{ $article->image->src }}" class="img-responsive">
						@else
						<div class="seperate"></div>
						<div class="text-center">
						تصویر آپلود نشده است!
						</div>
						@endif
						<div class="half-seperate"></div>
						<div class="bold">
							سرتیتر: 
							{{ $article->top_title }}
							<div class="one-third-seperate"></div>
							عنوان: 
							{{ $article->title }}
							<div class="one-third-seperate"></div>
							زیر عنوان:
							{{ $article->sub_title }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>دسته بندی:</label>
							{{ $article->category ? $article->category->title : 'ندارد'}}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>وضعیت:</label>
							{{ $article->status_translate() }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>نویسنده:</label>
							{{ $article->user ? $article->user->first_name : ''}}
							{{ $article->user ? $article->user->last_name : ''}}
							-
							آیدی کاربری:
							{{ $article->user ? $article->user->id : '-'}}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>عنوان در موتورهای جست جو:</label>
							{{ $article->meta_title ? $article->meta_title : $article->title }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>توضیحات در موتورهای جست جو:</label>
							{{ $article->meta_description }}
						</div>
						<div class="half-seperate"></div>
						تاریخ آخرین تغییر:
						<br>
						{{ \Nopaad\jDate::forge( $article->updated_at )->format(' %Y/%m/%d') }}
						<br>
						{{ \Nopaad\jDate::forge( $article->updated_at )->format(' %H:%M:%S') }}
						<hr>
						<div>
							<label>متن مقاله:</label>
							{!! $article->content !!}
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