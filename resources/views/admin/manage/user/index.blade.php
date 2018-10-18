@extends('admin.dashboard')
@section('title', 'کاربران')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-danger">
		<div class="panel-heading">مدیریت کاربران
			<a href="/admin/manage/user/report/excel" class="btn btn-primary btn-xs">گرفتن خروجی اکسل</a>
		</div>
		<div class="panel-body">
			<div class="half-seperate"></div>
			@include('admin.manage.user.search')
		</div>
		<div class="table-responsive">
		<table class="table table-hover table-striped">
		<tr>
			<th>
				<a class="inline-flex" sort="id"> شمارنده </a>
			</th>
			<th><a class="inline-flex" sort="last_name"> نام و نام‌خانوادگی </a></th>
			<th class="hidden-xs"><a class="inline-flex" sort="email"> ایمیل </a></th>
			<th><a class="inline-flex" sort="phone"> تلفن </a></th>
			<th>نقش‌ها</th>
			<th><a class="inline-flex" sort="status">وضعیت </a></th>
			<th class="hidden-xs"><a class="inline-flex" sort="created_at"> تاریخ </a></th>
			<th>عملیات</th>
		</tr>
		@foreach($users as $user)
			<tr
				class="
						@if($user->status != \App\Models\User::STATUS_ACTIVE) color-not-seen @endif
						">
				<td width="40" class="text-center">{{ $user->id }}</td>
				<td>{{ $user->first_name }}  {{ $user->last_name }}</td>
				<td class="text-left hidden-xs">{{ $user->email }}</td>
				<td>
					<div>{{ \Nopaad\Persian::correct($user->phone) }}</div>
				</td>
				<td style="max-width: 105px">
					<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#user-roles-modal" data-userid="{{ $user->id }}" data-username="{{ $user->first_name . ' ' . $user->last_name }}">
						+
					</button>
					@foreach($user->roles()->get() as $role)
						<span class="label label-default label-simple">
							{{ $role->description }}
						<a href="/admin/manage/user/{{ $user->id }}/remove/role/{{ $role->id }}" class="btn btn-xs btn-danger">
							<i class="fa fa-remove"></i>
						</a>
						</span>
					@endforeach
				</td>
				<td class="min-width-110">
					<select class="form-control" 
						onchange="statusChanged(this, {{ $user->id }}, 'user')">
						@foreach(\App\Models\User::$STATUS as $key => $value)
						<option value='{{$key}}' {{ $user->status == $key ? 'selected' : '' }}> {{$value}} </option> 
						@endforeach
					</select>
				</td>
				<td class="hidden-xs">
					{{ \Nopaad\jDate::forge( $user->created_at )->format(' %H:%M:%S') }}
					<br>
					{{ \Nopaad\jDate::forge( $user->created_at )->format(' %Y/%m/%d') }}
				</td>
				<td class="width-80px">
					<a href="/admin/manage/user/{{ $user->id }}">
						<span class="glyphicon glyphicon-eye-open"></span>
						مشاهده
					</a>
					<!-- <div class="one-third-seperate"></div>
					<a href="/admin/manage/user/{{ $user->id }}/edit">
						<span class="glyphicon glyphicon-pencil"></span>
						ویرایش
					</a> -->
					<div class="one-third-seperate"></div>
					<a href="/admin/manage/user/login/{{ $user->id }}">
						<span class="glyphicon glyphicon-log-in"></span>
						ورود
					</a>
					<div class="half-seperate"></div>
					<a href="/admin/manage/user/report/excel/{{ $user->id }}" class="btn btn-primary btn-xs">اکسل</a>
				</td>
			</tr>
		@endforeach
		</table>
		</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="text-center">
			{{ $users->links() }}
		</div>
	</div>
</div>
<div class="seperate"></div>
<h4 class="text-center page-header">اطلاع رسانی به کاربران موجود در لیست</h4>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-danger">
			<div class="panel-heading">ارسال ایمیل </div>
			<div class="panel-body">
				<form action="/admin/manage/user/notice/email" method="post">
						{{ csrf_field() }}
					<p class="bold">متن پیام:</p>
					<textarea class="form-control" name="content"></textarea>
					<input type="hidden" name="users_list_id" value="{{$users_list_id}}">
					<div class="seperate"></div>
					<div class="row">
						<div class="col-xs-4">
							<button type="submit" class="btn btn-danger">ارسال</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-warning">
			<div class="panel-heading">ارسال اس ام اس</div>
			<div class="panel-body">
				<form action="/admin/manage/user/notice/sms" method="post">
					{{ csrf_field() }}
					<p class="bold">متن پیام:</p>
					<textarea class="form-control" name="content"></textarea>
					<div class="seperate"></div>
					<input type="hidden" name="users_list_id" value="{{$users_list_id}}">
					<div class="row">
						<div class="col-xs-4">
							<button type="submit" class="btn btn-danger">ارسال</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="seperate"></div>
<div class="row">
	<div class="col-xs-12">
		<a href="/admin/manage/message" class="btn btn-primary btn-block">
			پیغام های ارسال شده از سیستم
		</a>
	</div>
</div>
<div class="seperate"></div>
<div class="seperate"></div>
<div class="seperate"></div>
<!-- user roles modal -->
<div class="modal fade" id="user-roles-modal" tabindex="-1" role="dialog" aria-labelledby="user-roles-modal-label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="user-roles-modal-label">
					افزودن نقش به
				</h4>
			</div>
			<form action="/admin/manage/user/role" method="POST">
				<div class="modal-body">
					<div class="one-third-separator"><!-- sep --></div>
					<div class="row">
						<div class="col-xs-12">
							{{ csrf_field() }}
							<input id="user-roles-modal-user-id" type="hidden" class="form-control readonly" readonly="readonly" value="userid" name="user_id"/>
							<select class="form-control" name="role_id">
								@foreach(\App\Models\Role::get() as $role)
									<option value="{{ $role->id }}">{{ $role->description }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">انصراف</button>
					<button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end model -->
@endsection
@push('script')
<script>
	jQuery('#user-roles-modal').on('show.bs.modal', function (e) {
		jQuery('#user-roles-modal-user-id').val(jQuery(e.relatedTarget).data('userid'));
	})
</script>

<script type="text/javascript">
	@if($query)
		var query = '{{ $query }}';
	@endif
</script>
<script src="{{ asset('js/sort.js') }}"></script>
@endpush


