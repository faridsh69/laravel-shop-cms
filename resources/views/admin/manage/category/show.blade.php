@extends('admin.dashboard')
@section('title', 'دسته بندی ها')

@section('content')
<div class="row">
	<div class="col-xs-12">
        <a href="/admin/manage/category/create" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد دسته بندی جدید</a>
    	<a href="/admin/manage/category/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست دسته بندیها</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				دسته بندی شماره {{ $category->id }}
				<a href="/admin/manage/category/{{$category->id}}/edit" class="btn btn-info btn-xs">
        			<span class="glyphicon glyphicon-pencil"></span>ویرایش</a>
        		<form action="/admin/manage/category/{{ $category->id }}" method="POST" class="display-inline">
				    {{ method_field('DELETE') }}
				    {{ csrf_field() }}
					<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> حذف</button>
				</form>
			</div>
			<div class="panel-boddy">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<div class="half-seperate"></div>
						@if($category->image)
						<img src="{{ $category->image->src }}" class="img-responsive">
						@else
						<div class="seperate"></div>
						<div class="text-center">
						تصویر آپلود نشده است!
						</div>
						@endif
						<div class="seperate"></div>
						<div class="bold">
							<div class="one-third-seperate"></div>
							عنوان: 
							{{ $category->title }}
							<div class="one-third-seperate"></div>
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>مادر: </label>
							@if($category->category)
								- {{ $category->category->title }} -
								<a href="/admin/manage/category/{{ $category->category->id }}">لینک</a>
							@else
								-
							@endif
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>نوع:</label>
							{{ $category->type }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>وضعیت:</label>
							{{ $category->status_translate() }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>نویسنده:</label>
							{{ $category->user ? $category->user->first_name : ''}}
							{{ $category->user ? $category->user->last_name : ''}}
							-
							آیدی کاربری:
							{{ $category->user ? $category->user->id : ''}}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>عنوان در موتورهای جست جو:</label>
							{{ $category->meta_title ? $category->meta_title : $category->title }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>توضیحات در موتورهای جست جو:</label>
							{{ $category->meta_description }}
						</div>
						<div class="half-seperate"></div>
						تاریخ آخرین تغییر:
						<br>
						{{ \Nopaad\jDate::forge( $category->updated_at )->format(' %Y/%m/%d') }}
						<br>
						{{ \Nopaad\jDate::forge( $category->updated_at )->format(' %H:%M:%S') }}
						<hr>
						<div>
							<label><b>توضیح:</b></label>
							{{ $category->content}}
						</div>
						@if(count($category->categories) > 0)
							<hr>
							<h4>
							زیر شاخه ها:
							</h4>
							@foreach($category->categories as $item)
							<div class="simple-box">
								<label><b> عنوان: </b></label>
								{{ $item->title}}
								<div class="half-seperate"></div>
								<a href="/admin/manage/category/{{ $item->id }}">لینک </a>
								<div class="half-seperate"></div>
								<label><b>توضیح:</b></label>
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