@extends('admin.dashboard')
@section('title', 'پرداخت')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
		<div class="panel-heading">پرداختی‌های من</div>
		<div class="table-responsive">
		<table class="table table-hover">
			<tr>
				<th width="40">شناسه</th>
				<th>مبلغ</th>
				<th>توضیحات</th>
				<th>شماره تراکنش</th>
				<th>وضعیت</th>
				<th>سفارش مربوطه</th>
				<th>تلفن کاربر</th>
				<th>تاریخ</th>
			</tr>
				@if( $payments->count() == 0)
				<tr>
					<td colspan="8">
					هنوز هیچ پرداختی انجام نداده اید.
					</td>
				</tr>
				@endif
			@foreach($payments as $payment)
				<tr class="{{ $payment->status ? 'success' : 'danger' }}">
					<td class="text-center" width="40">{{ \Nopaad\Persian::correct( $payment->id ) }}</td>
					<td>
						{{ \Nopaad\Persian::correct( number_format( $payment->amount , 0, '',',') ) }} تومان
					</td>
					<td  style="min-width:110px">
						{{ $payment->description }}
					</td>
					<td>
						{{ (int)$payment->Invoice_number }}
					</td>
					<td width="80px">
						{{ $payment->status ? 'پرداخت موفق' : 'ناموفق' }}
					</td>
					<td>
						<!-- <a href="/admin/my-order">مشاهده سفارش</a> -->
						@if($payment->order)
						سفارش {{ \Nopaad\Persian::correct( $payment->order->id ) }}
						@else
						{{ $payment->Invoice_date }}
						@endif
					</td>
					<td>
						{{ $payment->user->phone}}
					</td>
					<td>
						{{ \Nopaad\jDate::forge( $payment->updated_at )->format(' %H:%M:%S') }}
						<br>
						{{ \Nopaad\jDate::forge( $payment->updated_at )->format(' %Y/%m/%d') }}
					</td>
				</tr>
			@endforeach
		</table>
		</div>
		</div>

	</div>
</div>
<div class="row text-center">
	<div class="col-xs-12">
		{{ $payments->links() }}
	</div>
</div>
@endsection

