@extends('admin.dashboard')
@section('title', 'انجمن')
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
        <a href="/admin/manage/forum/create" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد پرسش و پاسخ جدید</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				پرسش و پاسخها
			</div>
			<div class="half-seperate"></div>
			<div class="col-xs-12">
				<form class="form-inline" method="GET">
				  	<div class="form-group">
				    	<label for="name">عنوان یا محتوا:</label>
				   	 	<input type="text" class="form-control input-sm" id="name" name="name" value="{{ 
				   	 	Request::input('name') }}">
				  	</div>
				  	<div class="form-group">
				    	<label for="category">دسته بندی: </label>
				    	<select class="form-control" name="category">
							<option value="">همه</option>
							@foreach($categories as $category)
								<option value="{{ $category->id }}"
								{{ Request::input('category') == $category->id ? "selected" : ""}} > 
									{{ $category->title }}
								</option>
							@endforeach
						</select>
				  	</div>
				  	<div class="form-group">
				  		<label for="status">وضعیت: </label>
					  	<select class="form-control" name="status" id="status">
							<option value="">همه</option>
							@foreach(\App\Models\User::$STATUS as $key => $value)
								<option value="{{ $key }}"> 
									{{ $value }}
								</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
				    	<label for="role">نقش کاربر: </label>
				    	<select class="form-control" name="role" id="role">
							<option value="">همه</option>
							@foreach(\App\Models\Role::get() as $role)
								<option value="{{ $role->id }}"
									{{ Request::input('role') == $role->id ? "selected" : ""}} >
									{{ $role->description }}
								</option>
							@endforeach
						</select>
				  	</div>
				  	<button type="submit" class="btn btn-default">جستجو</button>
			    	<span class="margin-right-10">
			    		{{ $forums->total() }} مورد یافت شد.
			    	</span>				  	
				</form>
	        </div>
			<div class="reponsive-table">
				<table class="table table-striped">
				<thead>
				<tr>
					<th>
						<a class="inline-flex" sort="id">
							شمارنده
						</a>
					</th>
					<th>
						<a class="inline-flex" sort="title">
							عنوان
						</a>
					</th>
					<th>
						<a class="inline-flex" sort="content">
							محتوا
						</a>
					</th>
					<th class="hidden-xs">
						<a class="inline-flex" sort="category_id">
							دسته بندی
						</a>
					</th>
					<th class="hidden-xs">
						<a class="inline-flex" sort="forum_id">
							پرسش / پاسخ
						</a>
					</th>
					<th class="hidden-xs">
						<a class="inline-flex" sort="user_id">
						نویسنده
						</a>
					</th>
					<th class="width-150px">
						<a class="inline-flex" sort="status">
						وضعیت
						</a>
					</th>
					<th class="hidden-xs">
						<a class="inline-flex" sort="views_count"> بازدید </a>
					</th>
					<th>
						عملیات
					</th>
				</tr>
				</thead>
				<tbody>
					@if( count($forums) == 0 )
					<tr>
						<td colspan="10">
							<div class="alert">
								موردی یافت نشد !
							</div>
						</td>
					</tr>
					@endif
					@foreach($forums as $forum)
					<tr class="{{$forum->admin_seen === 0 ? 'color-not-seen' : ''}} {{$forum->status != 1 ? 'color-not-active' : ''}}">
						<td class="text-center width-50px" >
							{{ $forum->id }}
						</td>
						<td>
							{{ $forum->title}}
						</td>
						<td class="content-column">
							{{ $forum->content}}
						</td>
						<td class="width-80px hidden-xs">
							{{ $forum->category ? $forum->category->title : 'ندارد'}}
						</td>
						<td class="width-20percent hidden-xs">
							{{ $forum->forum ? 'پاسخ به: ' . $forum->forum->title : 'پرسش'}}
						</td>
						<td class="hidden-xs">
							{{ $forum->user ? $forum->user->first_name : 'ندارد'}}
							{{ $forum->user ? $forum->user->last_name : 'ندارد'}}
							<br>
							@if($forum->user)
							@foreach( $forum->user->roles()->get() as $role)
							<span class="label label-success label-simple">{{ $role->description }}</span>
							@endforeach
							@endif
						</td>
						<td class="min-width-110">
							<select class="form-control" 
								onchange="statusChanged(this, {{ $forum->id }}, 'forum')">
								@foreach(\App\Models\Forum::$STATUS as $key => $value)
								<option value='{{$key}}' {{ $forum->status == $key ? 'selected' : '' }}> {{$value}} </option> 
								@endforeach
							</select>
							<br>
							تعداد
							پاسخ ها
							{{ $forum->answers_count() }}
						</td>
						<td class="width-50px hidden-xs">
							{{ $forum->views_count }}
						</td>
						<td class="width-80px">
							<a href="/admin/manage/forum/{{ $forum->id }}">
								<span class="glyphicon glyphicon-eye-open"></span>
								مشاهده
							</a>
							<div class="one-third-seperate"></div>
							<a href="/admin/manage/forum/{{ $forum->id }}/edit">
								<span class="glyphicon glyphicon-pencil"></span>
								ویرایش
							</a>
							<div class="one-third-seperate"></div>
							<form action="/admin/manage/forum/{{ $forum->id }}" method="POST" class="display-inline">
							    {{ method_field('DELETE') }}
							    {{ csrf_field() }}
								<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> حذف</button>
							</form>
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
			{{ $forums->links() }}
		</div>
	</div>
</div>
@endsection
@push('script')

<script type="text/javascript">
	@if($query)
		var query = '{{ $query }}';
	@endif
</script>
<script src="{{ asset('js/sort.js') }}"></script>

@endpush