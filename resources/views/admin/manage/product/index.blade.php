@extends('admin.dashboard')
@section('title', 'محصولات')
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
        <a href="/admin/manage/product/create" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد محصول جدید</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				محصولات
				<a href="/admin/manage/product/report/excel" class="btn btn-primary btn-xs">گرفتن خروجی اکسل</a>
				
			</div>
			<div class="half-seperate"></div>
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1">
					<!-- <div class="simple-guide">
						<a href="javascript:void(0)" class="btn btn-block color-danger">
							فاکتور پیگیری شود
						</a>
					</div> -->
					<div class="simple-guide">
						<a href="javascript:void(0)" class="btn btn-block color-success">
							موجود
						</a>
					</div>
					<div class="simple-guide">
						<a href="javascript:void(0)" class="btn btn-block color-not-active">
							غیر موجود
						</a>
					</div>
					<div class="simple-guide">
						<a href="javascript:void(0)" class="btn btn-block color-not-seen">
							موجودی زیر 10
						</a>
					</div>
				</div>
			</div>
			<div class="half-seperate"></div>
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1">
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
								@foreach(\App\Models\Product::$STATUS as $key => $value)
									<option value="{{ $key }}"> 
										{{ $value }}
									</option>
								@endforeach
							</select>
					  	</div>
					  	<button type="submit" class="btn btn-default">جستجو</button>
				    	<span class="margin-right-10">
				    		{{ $products->total() }} مورد یافت شد.
				    	</span>				  	
					</form>
		        </div>
	        </div>
			<div class="table-responsive">
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
						تصویر
					</th>
					<th class="hidden-xs">
						<a class="inline-flex" sort="category_id"> دسته بندی </a>
					</th>
					<th class="hidden-xs">
						<a class="inline-flex" sort="brand_id"> برند </a>
					</th>
					<th>
						<a class="inline-flex" sort="price"> قیمت / موجودی </a>
					</th>
					<th>
						<a class="inline-flex" sort="status"> وضعیت </a>
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
					@if( count($products) == 0 )
					<tr>
						<td colspan="10">
							<div class="alert">
								موردی یافت نشد !
							</div>
						</td>
					</tr>
					@endif
					@foreach($products as $product)
					<tr class="
						@if($product->inventory < 10)color-not-seen @endif
						@if($product->status == 1)color-success @endif
						@if($product->status != 1)color-not-active @endif
						">
						<td class="text-center width-50px" >
							{{ $product->id }}
							<br>
							{{ $product->group_id }}
						</td>
						<td>
							{{ $product->title}}
						</td>
						<td class="width-20percent">
							<img src="{{ $product->base_image_100() }}" class="img-thumbnail image-table">
						</td>
						<td class="hidden-xs">
							{{ $product->category ? $product->category->title : '-'}}
						</td>
						<td class="hidden-xs">
							{{ $product->brand ? $product->brand->title : '-'}}
						</td>
						<td id="no-quick-edit-id-{{ $product->id }}">
							<span>
								اصلی: {{ number_format($product->price) }}
								<div class="one-third-seperate"></div>
								تخفیف:
								{{ number_format($product->discount_price) }}
								<div class="one-third-seperate"></div>
								موجودی:
								{{ $product->inventory }}
							</span>
							<div class="half-seperate"></div>
							<button class="btn btn-xs btn-primary" onclick="quickEdit({{ $product->id }})">ویرایش سریع</button>
						</td>
						<td id="quick-edit-id-{{ $product->id }}" style="display: none;">
							<form action="{{ url('/admin/manage/product/quick-edit/'. $product->id) }}" method="post">
								{{ csrf_field() }}
								<span>
									<span>قیمت</span>
									<input type="text" name="price" placeholder="قیمت اصلی" 
										value="{{ $product->price }}" class="form-control">
									<div class="one-third-seperate"></div>
									<span>تخفیفی</span>
									<input type="text" name="discount_price" placeholder="قیمت تخفیفی" 	
										value="{{ $product->discount_price }}" class="form-control">
									<div class="one-third-seperate"></div>
									<span>موجودی</span>
									<input type="text" name="inventory" placeholder="موجودی" 
										value="{{ $product->inventory }}" class="form-control">
									<div class="one-third-seperate"></div>
									<button class="btn btn-xs btn-primary btn-block" type="submit">ذخیره</button>
								</span>
							</form>
						</td>
						<td class="min-width-140">
							<select class="form-control" 
								onchange="statusChanged(this, {{ $product->id }}, 'product')">
								@foreach(\App\Models\Product::$STATUS as $key => $value)
								<option value='{{$key}}' {{ $product->status == $key ? 'selected' : '' }}> {{$value}} </option> 
								@endforeach
							</select>
						</td>
						<td class="width-50px hidden-xs">
							{{ $product->views_count }}
						</td>
						<td class="width-80px">
							<a href="/admin/manage/product/{{ $product->id }}">
								<span class="glyphicon glyphicon-eye-open"></span>
								مشاهده
							</a>
							<div class="one-third-seperate"></div>
							<a href="/admin/manage/product/{{ $product->id }}/edit">
								<span class="glyphicon glyphicon-pencil"></span>
								ویرایش
							</a>
							<!-- <div class="one-third-seperate"></div>
							<form action="/admin/manage/product/{{ $product->id }}" method="POST" class="display-inline">
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
			{{ $products->links() }}
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

<script type="text/javascript">
	function quickEdit(id)
	{
		document.getElementById('no-quick-edit-id-'+ id).style.display = 'none';
		document.getElementById('quick-edit-id-'+ id).style.display = 'block';
	}
	
</script>
@endpush