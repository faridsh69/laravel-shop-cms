@extends('admin.dashboard')
@section('title', 'آگهی ها')
@section('content')
<div class="row">
	<div class="col-xs-12">
        <a href="/admin/manage/advertise/create" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد آگهی جدید</a>
    	<a href="/admin/manage/advertise/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست آگهی ها</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				آگهی شماره {{ $advertise->id }}
				<a href="/admin/manage/advertise/{{$advertise->id}}/edit" class="btn btn-info btn-xs">
        			<span class="glyphicon glyphicon-pencil"></span>ویرایش</a>
        		<form action="/admin/manage/advertise/{{ $advertise->id }}" method="POST" class="display-inline">
				    {{ method_field('DELETE') }}
				    {{ csrf_field() }}
					<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> حذف</button>
				</form>
			</div>
			<div class="panel-boddy">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<div class="seperate"></div>
						@if($advertise->images)
							@foreach($advertise->images as $image)
								<img src="{{ $image->src }}" class="img-thumbnail image-table">
							@endforeach
						@else
						<div class="seperate"></div>
						<div class="text-center">
							تصویر آپلود نشده است!
						</div>
						@endif

						<div class="half-seperate"></div>
						<div class="bold">
							عنوان: 
							{{ $advertise->title }}
						</div>
						<div class="half-seperate"></div>
						<div>
							قیمت : 
							{{ $advertise->price }} تومان
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>دسته بندی:</label>
							{{ $advertise->category ? $advertise->category->title : 'ندارد'}}
						</div>
						<div class="half-seperate"></div>
						<div>
							نوع قیمت: 
							{{ $advertise->price_type_translate() }}
						</div>
						<div class="half-seperate"></div>
						<div>
							اپراتور: 
							{{ $advertise->operator_type_translate() }}
						</div>
						<div class="half-seperate"></div>
						<div>
							نوع سیم کارت: 
							{{ $advertise->sim_cart_type_translate() }}
						</div>
						<div class="half-seperate"></div>
						<div>
							نوع قطعه: 
							{{ $advertise->noe_ghete }}
						</div>
						<div class="half-seperate"></div>
						<div>
							برند: 
							{{ $advertise->brand_title() }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>وضعیت:</label>
							{{ $advertise->status_translate() }}
						</div>	
						<div class="half-seperate"></div>
						<div>
							<label>نویسنده:</label>
							{{ $advertise->user ? $advertise->user->first_name : ''}}
							{{ $advertise->user ? $advertise->user->last_name : ''}}
							-
							آیدی کاربری:
							{{ $advertise->user ? $advertise->user->id : '-'}}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>شماره تماس:</label>
							{{ $advertise->phone }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>آدرس:</label>
							{{ $advertise->address }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>عنوان در موتور های جست جو:</label>
							{{ $advertise->meta_title ? $advertise->meta_title : $advertise->title }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>توضیحات در موتورهای جست جو:</label>
							{{ $advertise->meta_description }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>دلیل رد شدن آگهی:</label>
							{{ $advertise->why_not_accept_text }}
						</div>
						
						<div class="half-seperate"></div>
						تاریخ آخرین تغییر:
						<br>
						{{ \Nopaad\jDate::forge( $advertise->updated_at )->format(' %Y/%m/%d') }}
						<br>
						{{ \Nopaad\jDate::forge( $advertise->updated_at )->format(' %H:%M:%S') }}
						<hr>
						<div>
							<label>توضیحات:</label>
							{{ $advertise->description}}
						</div>
						<div class="seperate"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('script')



@endpush