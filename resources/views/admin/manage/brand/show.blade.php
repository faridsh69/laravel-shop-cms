@extends('admin.dashboard')
@section('title', 'برند ها')
@section('content')
<div class="row">
	<div class="col-xs-12">
        <a href="{{ route('brand.create') }}" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد برند جدید</a>
    	<a href="{{ route('brand.index') }}" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست برندها</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				برند شماره {{ $brand->id }}
				<a href="{{ route('brand.edit', $brand) }}" class="btn btn-info btn-xs">
        			<span class="glyphicon glyphicon-pencil"></span>ویرایش</a>
        		<form action="/admin/manage/brand/{{ $brand->id }}" method="POST" class="display-inline">
				    {{ method_field('DELETE') }}
				    {{ csrf_field() }}
					<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> حذف</button>
				</form>
			</div>
			<div class="panel-boddy">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<div class="seperate"></div>
						@if($brand->image)
						<img src="{{ $brand->image->src }}" class="img-responsive">
						@else
						<div class="seperate"></div>
						<div class="text-center">
						تصویر آپلود نشده است!
						</div>
						@endif
						<div class="half-seperate"></div>
						<div class="bold">
							عنوان: 
							{{ $brand->title }}
						</div>
						<div class="half-seperate"></div>
						<div class="half-seperate"></div>
						<div>
							<label>وضعیت:</label>
							{{ $brand->status_translate() }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>نویسنده:</label>
							{{ $brand->user ? $brand->user->first_name : ''}}
							{{ $brand->user ? $brand->user->last_name : ''}}
							-
							آیدی کاربری:
							{{ $brand->user ? $brand->user->id : ''}}
						</div>
						<div class="half-seperate"></div>
						تاریخ آخرین تغییر:
						<br>
						{{ \Nopaad\jDate::forge( $brand->updated_at )->format(' %Y/%m/%d') }}
						<br>
						{{ \Nopaad\jDate::forge( $brand->updated_at )->format(' %H:%M:%S') }}
						<hr>
						<div>
							<label>توضیحات برند:</label>
							{!! $brand->description !!}
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