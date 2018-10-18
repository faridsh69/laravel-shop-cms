@extends('admin.dashboard')
@section('title', 'سفارشات')
@section('content')
<div class="row">
	<div class="col-xs-12">
    	<a href="/admin/factor/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست سفارشات</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				سفارش شماره {{ $factor->id }}
			</div>
			<div class="panel-boddy">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1 col-xs-offset-0">
						<div class="half-seperate"></div>
						<div class="big-size">
							<div class="one-third-seperate"></div>
							<label>روش پرداخت:</label>
							{{ $factor->payment }}
							<div class="one-third-seperate"></div>
							<label>وضعیت سفارش:</label>
							{{ $factor->status_translate() }}
						</div>
						<div class="one-third-seperate"></div>
						@if($factor->last_payment())
							<label>وضعیت پرداخت:</label>
							{{ $factor->last_payment()->status_translate() }}
						@endif
						<hr>
						@each('common.factor-box', [$factor], 'factor')
						<hr>
						<label>پرداخت ها:</label>
						@each('common.payment-box', [$factor], 'factor')
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