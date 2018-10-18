@extends('admin.dashboard')
@section('content')
<div class="row">
	<div class="col-xs-12">
        <a href="/admin/manage/payment/create" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد دسته بندی جدید</a>
    	<a href="/admin/manage/payment/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست دسته بندیها</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				دسته بندی شماره {{ $payment->id }}
				<a href="/admin/manage/payment/{{$payment->id}}/edit" class="btn btn-info btn-xs">
        			<span class="glyphicon glyphicon-pencil"></span>ویرایش</a>
        		<form action="/admin/manage/payment/{{ $payment->id }}" method="POST" class="display-inline">
				    {{ method_field('DELETE') }}
				    {{ csrf_field() }}
					<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> حذف</button>
				</form>
			</div>
			<div class="panel-boddy">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<div class="half-seperate"></div>
						<div class="bold">
							<div class="one-third-seperate"></div>
							عنوان: 
							{{ $payment->title }}
							<div class="one-third-seperate"></div>
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>مادر: </label>
							@if($payment->payment)
								- {{ $payment->payment->title }} -
								<a href="/admin/manage/payment/{{ $payment->payment->id }}">لینک</a>
							@else
								-
							@endif
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>نوع:</label>
							{{ $payment->type }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>وضعیت:</label>
							{{ $payment->status_translate() }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>نویسنده:</label>
							{{ $payment->user ? $payment->user->first_name : ''}}
							{{ $payment->user ? $payment->user->last_name : ''}}
							-
							آیدی کاربری:
							{{ $payment->user ? $payment->user->id : ''}}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>عنوان در موتورهای جست جو:</label>
							{{ $payment->meta_title ? $payment->meta_title : $payment->title }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>توضیحات در موتورهای جست جو:</label>
							{{ $payment->meta_description }}
						</div>
						<div class="half-seperate"></div>
						تاریخ آخرین تغییر:
						<br>
						{{ \Nopaad\jDate::forge( $payment->updated_at )->format(' %Y/%m/%d') }}
						<br>
						{{ \Nopaad\jDate::forge( $payment->updated_at )->format(' %H:%M:%S') }}
						<hr>
						<div>
							<label><b>توضیح:</b></label>
							{{ $payment->content}}
						</div>
						@if(count($payment->categories) > 0)
							<hr>
							<h4>
							زیر شاخه ها:
							</h4>
							@foreach($payment->categories as $item)
							<div class="simple-box">
								<label><b> عنوان: </b></label>
								{{ $item->title}}
								<div class="half-seperate"></div>
								<a href="/admin/manage/payment/{{ $item->id }}">لینک </a>
								<div class="half-seperate"></div>
								<label><b>توضیح:</b></label>
								{{ $item->content}}
							</div>
							<div class="seperate"></div>
							@endforeach
						@endif
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