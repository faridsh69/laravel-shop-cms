@extends('admin.dashboard')
@section('title', 'مشاهده لاگ')
@section('breadcrumb')
	<ol class="breadcrumb">
		<li>داشبورد</li>
		<li class="active">مشاهده لاگ</li>
	</ol>
@stop
@section('content')
<div class="row">
	<div class="col-xs-12 ltr">
		<div class="block">
			<div class="block-inner">
			@foreach($log as $text)
			<p>
				{{$text}}
			</p>
			@endforeach	
			</div>
		</div>
	</div>
</div>
@endsection