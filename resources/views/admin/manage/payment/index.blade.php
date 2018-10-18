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
        <a href="/admin/manage/payment/create" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد دسته بندی جدید</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				دسته بندیها
			</div>
			<div class="half-seperate"></div>
			<div class="col-xs-12">
				<form class="form-inline" method="GET">
				  	<div class="form-group">
				    	<label for="name">عنوان یا توضیحات:</label>
				   	 	<input type="text" class="form-control input-sm" id="name" name="name" value="{{ 
				   	 	Request::input('name') }}">
				  	</div>
				  	<div class="form-group">
				    	<label for="type">نوع: </label>
				    	<select class="form-control" name="type">
							<option value="">همه</option>
							@foreach($types as $type)
								<option value="{{ $type }}"
								{{ Request::input('type') == $type ? "selected" : ""}} > 
									{{ $type }}
								</option>
							@endforeach
						</select>
				  	</div>
				  	<button type="submit" class="btn btn-default">جستجو</button>
			    	<span class="margin-right-10">
			    		{{ $categories->total() }} مورد یافت شد.
			    	</span>
				</form>
	        </div>
			<div class="reponsive-table">
				<table class="table table-striped">
				<thead>
				<tr>
					<th>
						@if(Request::input('sort') == 'id')
							@if(Request::input('order') == 'asc')
								<a href="{{url()->current()}}?name={{Request::input('name')}}&type={{Request::input('type')}}&sort=id&order=desc" class="inline-flex"> شمارنده <span class="glyphicon glyphicon-chevron-down"></span></a>
							@else
								<a href="{{url()->current()}}?name={{Request::input('name')}}&type={{Request::input('type')}}&sort=id&order=asc" class="inline-flex"> شمارنده <span class="glyphicon glyphicon-chevron-up"></span></a>
							@endif
						@else
							<a href="{{url()->current()}}?name={{Request::input('name')}}&type={{Request::input('type')}}&sort=id&order=asc"> شمارنده </a>
						@endif
					</th>
					<th>
						@if(Request::input('sort') == 'title')
							@if(Request::input('order') == 'asc')
								<a href="{{url()->current()}}?name={{Request::input('name')}}&type={{Request::input('type')}}&sort=title&order=desc" class="inline-flex"> عنوان <span class="glyphicon glyphicon-chevron-down"></span></a>
							@else
								<a href="{{url()->current()}}?name={{Request::input('name')}}&type={{Request::input('type')}}&sort=title&order=asc" class="inline-flex"> عنوان <span class="glyphicon glyphicon-chevron-up"></span></a>
							@endif
						@else
							<a href="{{url()->current()}}?name={{Request::input('name')}}&type={{Request::input('type')}}&sort=title&order=asc"> عنوان</a>
						@endif
					</th>
					<th>
						توضیحات
					</th>
					<th>
						نوع
					</th>
					<th>
						مادر
					</th>
					<th>
						نویسنده
					</th>
					<th>
						وضعیت
					</th>
					<th>
						عملیات
					</th>
				</tr>
				</thead>
				<tbody>
					@if( count($categories) == 0 )
					<tr>
						<td colspan="10">
							<div class="alert">
								موردی یافت نشد !
							</div>
						</td>
					</tr>
					@endif
					@foreach($categories as $payment)
					<tr>
						<td class="text-center width-50px" >
							{{ $payment->id }}
						</td>
						<td>
							{{ $payment->title}}
						</td>
						<td>
							{{ $payment->description}}
						</td>
						<td>
							{{ $payment->type}}
						</td>
						<td class="width-80px">
							@if($payment->payment && $payment->payment->payment )
							{{ $payment->payment ? $payment->payment->payment->title. ' -> ' : '-'}}
							@endif
							{{ $payment->payment ? $payment->payment->title : '-'}}
						</td>
						<td>
							{{ $payment->user ? $payment->user->first_name : '-'}}
							{{ $payment->user ? $payment->user->last_name : ''}}
						</td>
						<td>
							{{ $payment->status_translate() }}
						</td>
						<td class="width-80px">
							<a href="/admin/manage/payment/{{ $payment->id }}" class="btn btn-default btn-sm">
								<span class="glyphicon glyphicon-eye-open"></span>
								مشاهده
							</a>
							<div class="one-third-seperate"></div>
							<a href="/admin/manage/payment/{{ $payment->id }}/edit" class="btn btn-info btn-sm">
								<span class="glyphicon glyphicon-pencil"></span>
								ویرایش
							</a>
							<div class="one-third-seperate"></div>
							<form action="/admin/manage/payment/{{ $payment->id }}" method="POST" class="display-inline">
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
			{{ $categories->links() }}
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