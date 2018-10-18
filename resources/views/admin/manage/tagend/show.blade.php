@extends('admin.dashboard')
@section('title', 'زیر فاکتور ها')
@section('content')
<div class="row">
	<div class="col-xs-12">
        <a href="{{ route('tagend.create') }}" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد زیر فاکتور جدید</a>
    	<a href="{{ route('tagend.index') }}" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست زیر فاکتورها</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				زیر فاکتور شماره {{ $tagend->id }}
				<a href="{{ route('tagend.edit', $tagend) }}" class="btn btn-info btn-xs">
        			<span class="glyphicon glyphicon-pencil"></span>ویرایش</a>
        		<form action="/admin/manage/tagend/{{ $tagend->id }}" method="POST" class="display-inline">
				    {{ method_field('DELETE') }}
				    {{ csrf_field() }}
					<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> حذف</button>
				</form>
			</div>
			<div class="panel-boddy">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<div class="seperate"></div>
						@if($tagend->image)
						<img src="{{ $tagend->image->src }}" class="img-responsive">
						@else
						<div class="seperate"></div>
						<div class="text-center">
						تصویر آپلود نشده است!
						</div>
						@endif
						<div class="half-seperate"></div>
						<div class="bold">
							عنوان: 
							{{ $tagend->title }}
						</div>
						<div class="half-seperate"></div>
						<div class="half-seperate"></div>
						<div>
							<label>وضعیت:</label>
							{{ $tagend->status_translate() }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>نویسنده:</label>
							{{ $tagend->user ? $tagend->user->first_name : ''}}
							{{ $tagend->user ? $tagend->user->last_name : ''}}
							-
							آیدی کاربری:
							{{ $tagend->user ? $tagend->user->id : ''}}
						</div>
						<div class="half-seperate"></div>
						تاریخ آخرین تغییر:
						<br>
						{{ \Nopaad\jDate::forge( $tagend->updated_at )->format(' %Y/%m/%d') }}
						<br>
						{{ \Nopaad\jDate::forge( $tagend->updated_at )->format(' %H:%M:%S') }}
						<hr>
						<div>
							<label>توضیحات زیر فاکتور:</label>
							{!! $tagend->description !!}
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