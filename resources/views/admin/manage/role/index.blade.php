@extends('admin.dashboard')
@section('title', 'نقش ها')
@section('content')
<div class="row">
	<div class="col-xs-12">
		@foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
            <div class="alert alert-{{ $msg }} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul class="list-unstyled">
                    <li>{{ Session::get('alert-' . $msg) }}</li>
                </ul>
            </div>
            @endif
        @endforeach
        <a href="/admin/manage/role/create" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد نقش جدید</a>
    	<div class="half-seperate"></div>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				نقش ها
			</div>
			<div class="half-seperate"></div>
			<div class="col-xs-12">
			    	<span class="margin-right-10">
			    		{{ $roles->total() }} مورد یافت شد.
			    	</span>
	        </div>
			<div class="reponsive-table">
				<table class="table table-striped">
				<thead>
				<tr>
					<th>
						شماره
					</th>
					<th>
						نام
					</th>
					<th>
						توضیحات
					</th>
					<th>
						دسترسی ها
					</th>
					<th>
						عملیات
					</th>
				</tr>
				</thead>
				<tbody>
					@if( count($roles) == 0 )
					<tr>
						<td colspan="10">
							<div class="alert">
								موردی یافت نشد !
							</div>
						</td>
					</tr>
					@endif
					@foreach($roles as $role)
					<tr>
						<td class="text-center width-50px" >
							{{ $role->id }}
						</td>
						<td>
							{{ $role->name }}
						</td>
						<td>
							{{ $role->description }}
						</td>
						<td>
							@if($role->permissions)
								<ol>
								@foreach(json_decode($role->permissions) as $permission)
									<li>
									{{ trans('roles.' . Config::get('constants.permissions')[$permission] ) }}
									</li>
								@endforeach
								</ol>
							@endif
						</td>
						<td class="width-80px">
							<a href="/admin/manage/role/{{ $role->id }}">
								<span class="glyphicon glyphicon-eye-open"></span>
								مشاهده
							</a>
							<div class="one-third-seperate"></div>
							<a href="/admin/manage/role/{{ $role->id }}/edit">
								<span class="glyphicon glyphicon-pencil"></span>
								ویرایش
							</a>							
						</td>
					</tr>
					@endforeach
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="text-center">
			{{ $roles->links() }}
		</div>
	</div>
</div>
@endsection
@push('script')



@endpush