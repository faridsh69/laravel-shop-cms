@extends('admin.dashboard')
@section('title', 'نقش ها')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<a href="/admin/manage/role/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست نقش ها</a>
        <div class="half-seperate"></div>
		@if(isset($role) )
		<form enctype="multipart/form-data" method="post" action="/admin/manage/role/{{$role->id}}" id="form">
			{{ method_field('PUT') }}
		@else
		<form enctype="multipart/form-data" method="post" action="/admin/manage/role" id="form">
		@endif
			{{ csrf_field() }}
			<div class="panel {{ Request::segment(4) == 'edit' ? 'panel-info' :'panel-success'}} panel-default">
				<div class="panel-heading">
					@if(Request::segment(5) == 'edit')
						ویرایش نقش شماره: 
						{{ $role->id }}
						-
						{{ $role->name }}
					@else
						ایجاد نقش جدید
					@endif
					@if( isset($role) )
						<input type="hidden" name="id" value="{{ $role->id }}">
					@endif
				</div>
				<div class="half-seperate"></div>
				@if ($errors->all())
	            <div class="alert alert-danger alert-dismissible" role="alert">
	                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	                <ul class="list-unstyled">
	                @foreach($errors->all() as $error)
	                    <li>{{ $error }}</li>
	                @endforeach
	                </ul>
	            </div>
	        	@endif
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
	            <div class="one-third-seperate"></div>
            	<div class="table-responsive">
					<table class="table table-striped">
						<tr>
							<td><b>نام *</b></td>
							<td><input type="text" name="name" class="form-control"
							value="{{ $role->name or old('name') }}" required></td>
						</tr>
						<tr>
							<td>دسترسی ها</td>
							<td>
								<select id="permissions" class="form-control" name="permissions[]" multiple="">
									@foreach(\Config::get('constants.permissions') as $id => $value)
									<option value="{{ $id }}">
										{{ trans('roles.' . $value) }}
									</option>
									@endforeach
								</select>	
							</td>
						</tr>
						<tr>
							<td>توضیحات</td>
							<td><input type="text" name="description" class="form-control"
							value="{{ $role->description or old('description') }}"></td>
						</tr>
						<tr>
							<td colspan="20">
							<div class="col-xs-12">
								<button type="submit" class="btn btn-success btn-block">ذخیره اطلاعات</button>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="seperate"></div>
@endsection
@push('script')


@endpush