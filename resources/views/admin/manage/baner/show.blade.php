@extends('admin.dashboard')
@section('title', 'بنر ها')
@section('content')
<div class="row">
	<div class="col-xs-12">
        <a href="/admin/manage/baner/create" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد بنر جدید</a>
    	<a href="/admin/manage/baner/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست بنرها</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				بنر شماره {{ $baner->id }}
				<a href="/admin/manage/baner/{{$baner->id}}/edit" class="btn btn-info btn-xs">
        			<span class="glyphicon glyphicon-pencil"></span>ویرایش</a>
        		<form action="/admin/manage/baner/{{ $baner->id }}" method="POST" class="display-inline">
				    {{ method_field('DELETE') }}
				    {{ csrf_field() }}
					<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> حذف</button>
				</form>
			</div>
			<div class="panel-boddy">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<div class="seperate"></div>
						@if($baner->image_id)
						<img src="{{ $baner->image->src }}" class="img-responsive">
						@else
						<div class="seperate"></div>
						<div class="text-center">
						تصویر آپلود نشده است!
						</div>
						@endif
						<div class="half-seperate"></div>
						<div class="bold">
							عنوان: 
							{{ $baner->title }}
						</div>
						<div class="half-seperate"></div>
						<div class="half-seperate"></div>
						<div>
							<label>وضعیت:</label>
							{{ $baner->status_translate() }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>نویسنده:</label>
							{{ $baner->user ? $baner->user->first_name : ''}}
							{{ $baner->user ? $baner->user->last_name : ''}}
							-
							آیدی کاربری:
							{{ $baner->user ? $baner->user->id : ''}}
						</div>
						<div class="half-seperate"></div>
						تاریخ آخرین تغییر:
						<br>
						{{ \Nopaad\jDate::forge( $baner->updated_at )->format(' %Y/%m/%d') }}
						<br>
						{{ \Nopaad\jDate::forge( $baner->updated_at )->format(' %H:%M:%S') }}
						<hr>
						<div>
							<label>توضیحات بنر:</label>
							{!! $baner->description !!}
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