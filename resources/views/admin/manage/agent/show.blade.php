@extends('admin.dashboard')
@section('title', 'نمایندگی ها')
@section('content')
<div class="row">
	<div class="col-xs-12">
        <a href="{{ route('agent.create') }}" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد نمایندگی جدید</a>
    	<a href="{{ route('agent.index') }}" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست نمایندگیها</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				نمایندگی شماره {{ $agent->id }}
				<a href="{{ route('agent.edit', $agent) }}" class="btn btn-info btn-xs">
        			<span class="glyphicon glyphicon-pencil"></span>ویرایش</a>
        		<form action="/admin/manage/agent/{{ $agent->id }}" method="POST" class="display-inline">
				    {{ method_field('DELETE') }}
				    {{ csrf_field() }}
					<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> حذف</button>
				</form>
			</div>
			<div class="panel-boddy">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<div class="seperate"></div>
						@if($agent->image)
						<img src="{{ $agent->image->src }}" class="img-responsive">
						@else
						<div class="seperate"></div>
						<div class="text-center">
						تصویر آپلود نشده است!
						</div>
						@endif
						<div class="half-seperate"></div>
						<div class="half-seperate"></div>
						<div class="">
							@each('common.address-box', [$agent->address], 'address')
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>وضعیت:</label>
							{{ $agent->status_translate() }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>نویسنده:</label>
							{{ $agent->user ? $agent->user->first_name : ''}}
							{{ $agent->user ? $agent->user->last_name : ''}}
							-
							آیدی کاربری:
							{{ $agent->user ? $agent->user->id : ''}}
						</div>
						<div class="half-seperate"></div>
						تاریخ آخرین تغییر:
						<br>
						{{ \Nopaad\jDate::forge( $agent->updated_at )->format(' %Y/%m/%d') }}
						<br>
						{{ \Nopaad\jDate::forge( $agent->updated_at )->format(' %H:%M:%S') }}
						<hr>
						<div>
							<label>توضیحات نمایندگی:</label>
							{{ $agent->description}}
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