@extends('admin.dashboard')
@section('title', 'آگهی ها')
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
        <a href="/admin/advertise/create" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد آگهی جدید</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				آگهی ها 
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
				  	<button type="submit" class="btn btn-default">جستجو</button>
			    	<span class="margin-right-10">
			    		{{ $advertises->total() }} مورد یافت شد.
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
						<a class="inline-flex" sort="description">
						 توضیحات
						</a>
					</th>
					<th>
						<a>
						 	مشخصات
						</a>
					</th>
					<th>
						<a class="inline-flex" sort="phone">
						 شماره همراه
						</a>
					</th>
					<th>
						<a class="inline-flex" sort="category_id">
						 دسته بندی
						</a>
					</th>
					<th>
						<a class="inline-flex" sort="user_id">
						 نویسنده
						</a>
					</th>
					<th>
						تصویر
					</th>
					<th>
						<a class="inline-flex" sort="price">
						 قیمت
						</a>
					</th>
					<th>
						<a class="inline-flex" sort="status">
						 وضعیت
						</a>
					</th>
					<th>
						عملیات
					</th>
				</tr>
				</thead>
				<tbody>
					@if( count($advertises) == 0 )
					<tr>
						<td colspan="10">
							<div class="alert">
								موردی یافت نشد !
							</div>
						</td>
					</tr>
					@endif
					@foreach($advertises as $advertise)
					<tr>
						<td class="text-center width-50px" >
							{{ $advertise->id }}
							<br><br>
							{{ $advertise->group_id }}
						</td>
						<td>
							{{ $advertise->title}}
						</td>
						<td>
							{{ $advertise->description}}
						</td>
						<td class="width-150px">
							نوع قیمت:
							{{ $advertise->price_type_translate() }}
							<br> برند:
							{{ $advertise->brand_title() }}
							<br> نوع قطعه:
							{{ $advertise->noe_ghete }}
							<br> نوع سیم کارت:
							{{ $advertise->sim_cart_type_translate() }}
							<br> اپراتور:
							{{ $advertise->operator_type_translate() }}
							<br> شماره سیم کارت:
							{{ $advertise->sim_cart_number }}
						</td>
						<td>
							{{ $advertise->phone }}
						</td>
						<td>
							{{ $advertise->category ? $advertise->category->title : '-'}}
						</td>
						<td>
							{{ $advertise->user ? $advertise->user->first_name : '-'}}
							{{ $advertise->user ? $advertise->user->last_name : ''}}
						</td>
						<td class="width-20percent">
							@if($advertise->images)
								@foreach($advertise->images as $image)
									<img src="{{ $image->src100 }}" class="img-thumbnail image-table">
								@break
								@endforeach
							@else
								تصویر ندارد
							@endif

						</td>
						<td class="width-120px">
							{{ $advertise->price ? $advertise->price : 0 }} 
							<small>تومان</small>
						</td>
						<td class="width-120px">
							{{ $advertise->status_translate() }}
							<br>
							@if( $advertise->why_not_accept_text )
							<label class="label label-danger">دلیل رد شدن آگهی:</label>
							<br>
							<br>
							{{ $advertise->why_not_accept_text }}
							@endif
						</td>
						<td class="width-80px">
							<a href="/admin/advertise/{{ $advertise->id }}">
								<span class="glyphicon glyphicon-eye-open"></span>
								مشاهده
							</a>
							<div class="one-third-seperate"></div>
							<a href="/admin/advertise/{{ $advertise->id }}/edit">
								<span class="glyphicon glyphicon-pencil"></span>
								ویرایش
							</a>
							<div class="one-third-seperate"></div>
							<form action="/admin/advertise/{{ $advertise->id }}" method="POST" class="display-inline">
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
			{{ $advertises->links() }}
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