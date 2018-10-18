@extends('layout.print')
@section('container')
<div class="double-seperate hidden-print"></div>
<a class="btn btn-block btn-primary hidden-print" href="/admin/manage/factor">بازگشت
<span class="glyphicon glyphicon-arrow-left"></span>  </a>
<div class="double-seperate hidden-print"></div>
<div class="text-center">
	سفارش از {{ $constant['name'] }}
</div>
<div class="seperate"></div>
<div class="row">
	<div class="col-xs-6">
	تاریخ ثبت سفارش:
	{{ \Nopaad\jDate::forge( $factor->updated_at )->format(' %Y/%m/%d') }}
	</div>
	<div class="col-xs-6">
		<div style="float:left">
		ساعت:
		{{ \Nopaad\jDate::forge( $factor->updated_at )->format(' %H:%M:%S') }}
		</div>
	</div>
</div>
<div class="half-seperate"></div>
<div class="seperate"></div>
<div class="row">
	<div class="col-xs-12">
		<hr>
	</div>
</div>
@each('common.factor-box', [$factor], 'factor')
<script type="text/javascript">
	window.print();
</script>
@endsection