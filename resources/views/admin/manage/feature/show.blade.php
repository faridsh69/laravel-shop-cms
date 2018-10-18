@extends('admin.dashboard')
@section('title', 'ویژگی ها')
@section('content')
<div class="row">
	<div class="col-xs-12">
        <a href="/admin/manage/feature/create" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد ویژگی جدید</a>
    	<a href="/admin/manage/feature/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست ویژگی ها</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				ویژگی شماره {{ $feature->id }}
				<a href="/admin/manage/feature/{{$feature->id}}/edit" class="btn btn-info btn-xs">
        			<span class="glyphicon glyphicon-pencil"></span>ویرایش</a>
        		<form action="/admin/manage/feature/{{ $feature->id }}" method="POST" class="display-inline">
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
							عنوان: 
							{{ $feature->title }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>نوع:</label>
							{{ $feature->type }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>انتخاب ها:</label>
							{{ $feature->options }}
						</div>
						<div class="half-seperate"></div>
						<div class="bold">
							واحد: 
							{{ $feature->unit }}
						<div class="half-seperate"></div>
						</div>
						<div>
							<label>دسته بندی:</label>
							{{ $feature->category ? $feature->category->title : 'ندارد'}}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>وضعیت:</label>
							{{ $feature->status_translate() }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>نویسنده:</label>
							{{ $feature->user ? $feature->user->first_name : ''}}
							{{ $feature->user ? $feature->user->last_name : ''}}
							-
							آیدی کاربری:
							{{ $feature->user ? $feature->user->id : '-'}}
						</div>						
						<div class="half-seperate"></div>
						تاریخ آخرین تغییر:
						<br>
						{{ \Nopaad\jDate::forge( $feature->updated_at )->format(' %Y/%m/%d') }}
						<br>
						{{ \Nopaad\jDate::forge( $feature->updated_at )->format(' %H:%M:%S') }}
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