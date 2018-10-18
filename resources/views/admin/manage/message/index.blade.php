@extends('admin.dashboard')
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
        <!-- <a href="/admin/manage/message/create" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد پیام جدید</a> -->
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				پیامها
			</div>
			<div class="half-seperate"></div>
			<div class="col-xs-12">
				<!-- <form class="form-inline" method="GET">
				  	<div class="form-group">
				    	<label for="name">عنوان یا توضیح:</label>
				   	 	<input type="text" class="form-control input-sm" id="name" name="name" value="{{ 
				   	 	Request::input('name') }}">
				  	</div>
				  	<button type="submit" class="btn btn-default">جستجو</button>
			    	<span class="margin-right-10">
			    		
			    	</span>				  	
				</form> -->
				{{ $messages->total() }} مورد یافت شد.
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
						<a class="inline-flex" sort="message"> متن پیام </a>
					</th>
					<th>
						<a class="inline-flex" sort="users_list_id"> کد کاربران </a>
					</th>
					<th>
						<a class="inline-flex" sort="user_id"> فرستنده </a>
					</th>
					<th>
						<a class="inline-flex" sort="status"> وضعیت </a>
					</th>
					<th>
						عملیات
					</th>
				</tr>
				</thead>
				<tbody>
					@if( count($messages) == 0 )
					<tr>
						<td colspan="10">
							<div class="alert">
								موردی یافت نشد !
							</div>
						</td>
					</tr>
					@endif
					@foreach($messages as $message)
					<tr>
						<td class="text-center width-50px" >
							{{ $message->id }}
						</td>
						<td>
							{{ $message->message }}
						</td>
						<td class="content-column">
							{{ $message->users_list_id}}
						</td>
						<td>
							{{ $message->user ? $message->user->first_name : 'ندارد'}}
							{{ $message->user ? $message->user->last_name : 'ندارد'}}
						</td>
						<td>
							{{ $message->status_translate() }}
							
						</td>
						<td class="width-80px">
							ندارد
							<!-- <a href="/admin/manage/message/{{ $message->id }}">
								<span class="glyphicon glyphicon-eye-open"></span>
								مشاهده
							</a> -->
							<!-- <div class="one-third-seperate"></div>
							<a href="/admin/manage/message/{{ $message->id }}/edit">
								<span class="glyphicon glyphicon-pencil"></span>
								ویرایش
							</a> -->
							<!-- <div class="one-third-seperate"></div>
							<form action="/admin/manage/message/{{ $message->id }}" method="POST" class="display-inline">
							    {{ method_field('DELETE') }}
							    {{ csrf_field() }}
								<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> حذف</button>
							</form> -->
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
			{{ $messages->links() }}
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