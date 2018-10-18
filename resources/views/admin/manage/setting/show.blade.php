@extends('admin.dashboard')
@section('title', 'تنظیمات')
@section('content')
<div class="row">
	<div class="col-xs-12">
        <a href="/admin/manage/setting/create" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد ویژگی جدید</a>
    	<a href="/admin/manage/setting/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست ویژگی ها</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				ویژگی شماره {{ $setting->id }}
				<a href="/admin/manage/setting/{{$setting->id}}/edit" class="btn btn-info btn-xs">
        			<span class="glyphicon glyphicon-pencil"></span>ویرایش</a>
			</div>
			<div class="panel-boddy">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<div class="half-seperate"></div>
						<div class="bold">
							عنوان: 
							{{ $setting->key }}
						</div>
						<div class="half-seperate"></div>
						<div class="bold">
							مقدار: 
							{{ $setting->value }}
						<div class="half-seperate"></div>
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>توضیحات:</label>
							{{ $setting->description }}
						</div>
						<div class="half-seperate"></div>
						<div class="half-seperate"></div>
						تاریخ آخرین تغییر:
						<br>
						{{ \Nopaad\jDate::forge( $setting->updated_at )->format(' %Y/%m/%d') }}
						<br>
						{{ \Nopaad\jDate::forge( $setting->updated_at )->format(' %H:%M:%S') }}
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