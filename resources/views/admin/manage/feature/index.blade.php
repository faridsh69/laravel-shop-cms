@extends('admin.dashboard')
@section('title', 'ویژگی ها')
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
        <a href="/admin/manage/feature/create" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد ویژگی جدید</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				ویژگی ها
			</div>
			<div class="half-seperate"></div>
			<div class="col-xs-12">
				<form class="form-inline" method="GET">
				  	<div class="form-group">
				    	<label for="name">عنوان: </label>
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
				  	<!-- <div class="form-group"> -->
				    	<span class="margin-right-10">
				    		{{ $features->total() }} مورد یافت شد.
				    	</span>
				    <!-- </div> -->
				  	
				</form>
	        </div>
			<div class="reponsive-table">
				<table class="table table-striped">
				<thead>
				<tr>
					<th>
						<a class="inline-flex" sort="id"> شمارنده </a>
					</th>
					<th>
						<a class="inline-flex" sort="title"> عنوان </a>
					</th>
					<th>
						<a class="inline-flex" sort="type"> نوع </a>
					</th>
					<th>
						<a class="inline-flex" sort="category_id"> ویژگی دسته محصولات </a>
					</th>
					<th class="hidden-xs">
						<a class="inline-flex" sort="price_affected"> تاثیر بر قیمت </a>
					</th>
					<th class="hidden-xs">
						<a class="inline-flex" sort="user_id"> نویسنده </a>
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
					@if( count($features) == 0 )
					<tr>
						<td colspan="10">
							<div class="alert">
								موردی یافت نشد !
							</div>
						</td>
					</tr>
					@endif
					@foreach($features as $feature)
					<tr>
						<td class="text-center width-50px" >
							{{ $feature->id }}
						</td>
						<td>
							{{ $feature->title}}
						</td>
						<td>
							{{ $feature->type ? $feature->type : 'نوع متنی پیشفرض'}}
							<div class="one-third-seperate"></div>
							@if($feature->unit)
							واحد: ({{ $feature->unit }})
							@endif	
							<div class="one-third-seperate"></div>
							@if($feature->options)
								@if( 1 == 2 )
									@foreach( json_decode($feature->options) as $item )
									<i class="small-size bold margin-right-3">
										{{ $item }}
									</i>
									+
									@endforeach
								@endif
							@endif
						</td>
						<td>
							{{ $feature->category ? $feature->category->title : '-'}}
						</td>
						<td class="hidden-xs">
							{{ $feature->price_affected == 1 ? 'بله' : 'خیر'}}
						</td>
						<td class="hidden-xs">
							{{ $feature->user ? $feature->user->first_name : ''}}
							{{ $feature->user ? $feature->user->last_name : '-'}}
						</td>
						<td class="min-width-110">
							<select class="form-control" 
								onchange="statusChanged(this, {{ $feature->id }}, 'feature')">
								@foreach(\App\Models\Feature::$STATUS as $key => $value)
								<option value='{{$key}}' {{ $feature->status == $key ? 'selected' : '' }}> {{$value}} </option> 
								@endforeach
							</select>
						</td>
						<td class="width-80px">
							<a href="/admin/manage/feature/{{ $feature->id }}">
								<span class="glyphicon glyphicon-eye-open"></span>
								مشاهده
							</a>
							<div class="one-third-seperate"></div>
							<a href="/admin/manage/feature/{{ $feature->id }}/edit">
								<span class="glyphicon glyphicon-pencil"></span>
								ویرایش
							</a>
							<!-- <div class="one-third-seperate"></div>
							<form action="/admin/manage/feature/{{ $feature->id }}" method="POST" class="display-inline">
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
			{{ $features->links() }}
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