@extends('admin.dashboard')
@section('title', 'محصولات')
@section('content')
<div class="row">
	<div class="col-xs-12">
        <a href="/admin/manage/product/create" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد محصول جدید</a>
    	<a href="/admin/manage/product/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست محصولات</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				محصول شماره {{ $product->id }}
				<a href="/admin/manage/product/{{$product->id}}/edit" class="btn btn-info btn-xs">
        			<span class="glyphicon glyphicon-pencil"></span>ویرایش</a>
        		<form action="/admin/manage/product/{{ $product->id }}" method="POST" class="display-inline">
				    {{ method_field('DELETE') }}
				    {{ csrf_field() }}
					<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> حذف</button>
				</form>
			</div>
			<div class="panel-boddy">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<div class="seperate"></div>
						@if( count($product->images) > 0 )
							@foreach($product->images as $image)
								<img src="{{ $image->src }}" class="img-thumbnail image-table">
							@endforeach
						@else
						<div class="seperate"></div>
						<div class="text-center">
							تصویر آپلود نشده است!
						</div>
						@endif
						<hr>
						<div class="half-seperate"></div>
						<div class="bold double-size">
							نام محصول: 
							{{ $product->title }}
							<div class="one-third-seperate"></div>
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>دسته بندی:</label>
							{{ $product->category ? $product->category->title : 'ندارد'}}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>برند:</label>
							{{ $product->brand ? $product->brand->title : 'ندارد'}}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>وضعیت:</label>
							{{ $product->status_translate() }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>موجودی:</label>
							{{ $product->inventory }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>قیمت:</label>
							{{ number_format($product->price) }} تومان
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>قیمت با تخفیف:</label>
						@if( $product->discount_price )
							{{ number_format($product->discount_price) }} تومان
						@else
						ندارد
						@endif
						</div>
						<div class="seperate"></div>
						@if($product->features)
							<h4 class="page-header">ویژگی های کالا:</h4>
							@foreach($product->features as $feature)
								<div>
									{{ $feature->title }}: 
									{{ $feature->pivot->data }}
								</div>
								<div class="one-third-seperate"></div>
							@endforeach
						<hr>
						@endif
						
						<div class="half-seperate"></div>
						<div>
							<label>نویسنده:</label>
							{{ $product->user ? $product->user->first_name : ''}}
							{{ $product->user ? $product->user->last_name : ''}}
							-
							آیدی کاربری:
							{{ $product->user ? $product->user->id : '-'}}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>عنوان در موتورهای جست جو:</label>
							{{ $product->meta_title ? $product->meta_title : $product->title }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>توضیحات در موتورهای جست جو:</label>
							{{ $product->meta_description }}
						</div>
						<div class="half-seperate"></div>
						تاریخ آخرین تغییر:
						<br>
						{{ \Nopaad\jDate::forge( $product->updated_at )->format(' %Y/%m/%d') }}
						<br>
						{{ \Nopaad\jDate::forge( $product->updated_at )->format(' %H:%M:%S') }}
						<div class="seperate"></div>
						بازدید:
						{{ $product->views->count() }}
						بار
						<hr>

						<div>
							<label>توضیح محصول:</label>
							{!! $product->description !!}
						</div>
						<div class="seperate"></div>
						<div>
							محصولات مشابه
							<ol>
							@foreach( $product->related_products as $rp )
								<li> {{ App\Models\Product::where('id', $rp->related_product_id)->first()->title }} </li>
							@endforeach
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('script')



@endpush