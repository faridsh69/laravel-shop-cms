@extends('admin.dashboard')
@section('title', 'نقش ها')
@section('content')
<div class="row">
	<div class="col-xs-12">
        <a href="/admin/manage/role/create" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد نقش جدید</a>
    	<a href="/admin/manage/role/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست نقش ها</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				نقش شماره {{ $role->id }}
				<a href="/admin/manage/role/{{$role->id}}/edit" class="btn btn-info btn-xs">
        			<span class="glyphicon glyphicon-pencil"></span>ویرایش</a>
			</div>
			<div class="panel-boddy">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<div class="half-seperate"></div>
						<div class="bold">
							عنوان: 
							{{ $role->name }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>توضیحات:</label>
							{{ $role->description }}
						</div>
						<div class="half-seperate"></div>
						<div class="bold">
							دسترسی ها: 
							@if($role->permissions)
								<ol>
								@foreach(json_decode($role->permissions) as $permission)
									<li>
									{{ trans('roles.' . Config::get('constants.permissions')[$permission] ) }}
									</li>
								@endforeach
								</ol>
							@endif
						</div>
						<div class="half-seperate"></div>
						تاریخ آخرین تغییر:
						<br>
						{{ \Nopaad\jDate::forge( $role->updated_at )->format(' %Y/%m/%d') }}
						<br>
						{{ \Nopaad\jDate::forge( $role->updated_at )->format(' %H:%M:%S') }}
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