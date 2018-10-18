@extends('admin.dashboard')
@section('title', 'محصولات')
@push('style')
<link rel="stylesheet" href="{{ asset('css/sumoselect.css') }}">
@endpush
@section('content')
<div class="row">
	<div class="col-xs-12">
		<a href="/admin/manage/product/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست محصولات</a>
        <div class="half-seperate"></div>
		@if(isset($product) )
		<form enctype="multipart/form-data" method="post" action="/admin/manage/product/{{$product->id}}" id="form">
			{{ method_field('PUT') }}
		@else
		<form enctype="multipart/form-data" method="post" action="/admin/manage/product" id="form">
		@endif
			{{ csrf_field() }}
			<div class="panel {{ Request::segment(4) == 'edit' ? 'panel-info' :'panel-success'}} panel-default">
				<div class="panel-heading">
					@if(Request::segment(4) == 'edit')
						ویرایش محصول شماره: 
						{{ $product->id }}
						-
						{{ $product->title }}
					@else
						ایجاد محصول جدید
					@endif
					@if( isset($product) )
						<input type="hidden" name="id" value="{{ $product->id }}">
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
							<td colspan="20">
							<div class="col-xs-12">
								<button type="submit" class="btn btn-success btn-block">ذخیره اطلاعات</button>
								</div>
							</td>
						</tr>
						<tr>
							<td class="width-120"><b>عنوان محصول *</b> </td>
							<td><input type="text" name="title" class="form-control"
							value="{{ $product->title or old('title') }}" required></td>
						</tr>
						<tr>
							<td class="width-120"><b> برند</b> </td>
							<td>
								<select class="form-control" name="brand_id" id="brand_id">
									@foreach(\App\Models\Brand::select('id', 'title')
										->Active()->orderBy('id', 'desc')->get() as $brand)
										<option value="{{ $brand->id }}">
											{{ $brand->title }}
										</option>
									@endforeach
								</select>
							</td>
						</tr>							
					</table>
					<product-field :id="@if(isset($product)){{ $product->id }}@else{{ 0 }}@endif"></product-field>
					<table class="table table-striped">	
						
						<!-- <tr>
							<td><b>قیمت(تومان) *</b></td>
							<td><input type="number" name="price" class="form-control"
							value="{{ $product->price or old('price') }}" required=""></td>
						</tr> -->
						<!-- <tr>
							<td><b>قیمت تخفیف خورده</b></td>
							<td><input type="text" name="discount_price" class="form-control"
							value="{{ $product->discount_price or old('discount_price') }}">
							<div class="help-block">دقت شود این فیلد باید خالی باشد در غیر اینصورت این مبلغ محاسبه می شود. به این معنی که صفر نگذارید چون رایگان حساب می شود.</div>
							</td>
						</tr> -->

						<!-- <tr>
							<td>موجودی</td>
							<td><input type="text" name="inventory" class="form-control"
							value="{{ $product->inventory or old('inventory') }}" required=""></td>
						</tr> -->
						<!-- <tr>
							<td>وضعیت</td>
							<td>
								<select class="form-control" name="status">
									@foreach(\App\Models\Product::$STATUS as $key => $value)
									<option value='{{$key}}'> {{$value}} </option> 
									@endforeach
								</select>
							</td>
						</tr> -->
						<tr>
							<td><b>توضیحات محصول *</b></td>
							<td><textarea class="ckeditor" name="description">{{ $product->description or old('description') }}</textarea></td>
						</tr>
						<tr>
							<td class="width-120">عنوان در موتورهای جستجو</td>
							<td><input type="text" name="meta_title" class="form-control"
							value="{{ $product->meta_title or old('meta_title') }}">
						</tr>
						<tr>
							<td>توضیحات در موتورهای جستجو</td>
							<td><input type="text" name="meta_description" class="form-control"
							value="{{ $product->meta_description or old('meta_description') }}"></td>
						</tr>
						<tr>
							<td class="width-120">محصولات مشابه</td>
							<td>
								<select multiple="" class="multi-select" name="related_product[]">
									@foreach($related_products_all as $related_product)
									<option value="{{ $related_product->id }}"
										@if( array_search( $related_product->id ,$related_products) !== false )
										selected
										@endif
										>{{ $related_product->title}}
									</option>
									@endforeach
								</select>
								<div class="help-block">دقیقا 4 محصول مشابه را انتخاب نمایید</div>
							</td>
						</tr>
						<tr>
							<td>آپلود عکس 
							<small class="help-block">تصویری با طول و عرض برابر وارد کنید.<br> حداقل کیفیت 400 در 400 پیکسل باشد.</small>
							</td>
							<td>
								<input id="file" type="file" accept='image/*' name="" />
								<div class="half-seperate"></div>
								<button id="cropbutton" type="button" class="btn btn-info btn-xs">
										برش عکس
								</button>
								<button id="uploadImage" type="button" class="farid btn btn-info btn-xs">
									<i class="fa fa-1x fa-upload"></i>
									آپلود عکس
								</button>
								<div class="half-seperate"></div>
								<div id="views"></div>
								<div class="text-center">
									<img id='preview' class="img-responsive img-thumbnail">
								</div>
							</td>		
						</tr>
						<tr>
							<td>گالری عکس ها
								<div class="alert alert-success" id="upload-success">
									عکس با موفقیت ذخیره شد
								</div>
								<div class="alert alert-danger" id="upload-error">
									عکس آپلود نشد
								</div>
							</td>
							<td id="gallery">
								@if(isset($product))
									@if($product->images)
										@foreach($product->images as $image)
										<div class="col-sm-3 text-center">
											<img src="{{ $image->src100 }}" class="img-thumbnail  img-responsive">
											<a href="/admin/delete-image/{{$image->id}}" class="btn btn-xs btn-danger">جذف <i class="fa fa-remove"></i> </a>
										</div>
										@endforeach
									@else
									<div class="seperate"></div>
									<div class="text-center">
										تصویر آپلود نشده است!
									</div>
									@endif
								@endif
							</td>
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
<script src="{{ asset('js/jquery.sumoselect.min.js') }}"></script>
<script type="text/javascript">
	$('.multi-select').SumoSelect();
</script>
@endpush