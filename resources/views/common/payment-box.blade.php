<div class="reponsive-table">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th width="40">شناسه</th>
				<th>مبلغ</th>
				<th>وضعیت</th>
				<th>نتیجه</th>
				<th>شماره ارجاع بانک</th>
				<th>شماره تراکنش</th>
				<th>تاریخ</th>
			</tr>
		</thead>
		<tbody>
			@if( count($factor->payments) == 0)
			<tr>
				<td colspan="8">
				هنوز هیچ پرداختی انجام نداده اید.
				</td>
			</tr>
			@endif
			@foreach($factor->payments as $payment)
			<tr class="{{$payment->status != 0 ? 'color-not-active' : ''}}">
				<td class="text-center" width="40">{{ \Nopaad\Persian::correct( $payment->id ) }}</td>
				<td>
					{{ \Nopaad\Persian::correct( number_format( $payment->total_price , 0, '',',') ) }} تومان
				</td>
				<td width="80px">
					{{ $payment->status_translate() }}
				</td>
				<td  style="min-width:110px">
					{{ $payment->description }}
					<div class="half-seperate"></div>
					{{ $payment->error }}
				</td>
				<td>
					{{ $payment->refId }}
				</td>
				<td>
					{{ $payment->transaction_id }}
				</td>
				<td>
					{{ \Nopaad\jDate::forge( $payment->updated_at )->format(' %H:%M:%S') }}
					<br>
					{{ \Nopaad\jDate::forge( $payment->updated_at )->format(' %Y/%m/%d') }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>