@extends('admin.dashboard')
@section('title', 'سفارشات')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
		<div class="panel-heading">پرداختی‌های من</div>
		<div class="table-responsive">
		<table class="table table-hover">
			<tr>
				<th width="40">شناسه</th>
				<th>نظر</th>
				<th>تلفن کاربر</th>
				<th>تاریخ</th>
			</tr>
			@foreach($comments as $comment)
				<tr>
					<td class="text-center" width="40">{{ \Nopaad\Persian::correct( $comment->id ) }}</td>
					<td>
						{{ $comment->comment }}
					</td>
					<td>
						{{ $comment->user->phone}}
					</td>
					<td>
						{{ \Nopaad\jDate::forge( $comment->updated_at )->format(' %H:%M:%S') }}
						<br>
						{{ \Nopaad\jDate::forge( $comment->updated_at )->format(' %Y/%m/%d') }}
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
		{{ $comments->links() }}
	</div>
</div>
@endsection

