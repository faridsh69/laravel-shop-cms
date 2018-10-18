@extends('admin.dashboard')
@section('title', 'منو ها')
@push('style')
@endpush
@section('content')
<div class="row">
	<div class="col-xs-12">
		@foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
            <div class="alert alert-{{ $msg }} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul class="list-unstyled">
                    <li>{{ Session::get('alert-' . $msg) }}</li>
                </ul>
            </div>
            @endif
        @endforeach
        <a href="/admin/manage/content/menu/create" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد منو جدید</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				منوها
			</div>
			<div class="half-seperate"></div>

			<ul class="nav nav-tabs">
			    <li class="active"><a data-toggle="tab" href="#header">منو نوار بالای صفحه</a></li>
			    <li><a data-toggle="tab" href="#footer">منو فوتر</a></li>
			</ul>

			<div class="tab-content">
				@each('admin.manage.content.menu.table', $menu_types, 'menu_type')
            </div>
            <hr>
		</div>
	</div>
</div>
@endsection

@push('script')
<script type="text/javascript">
	@if($query)
		var query = '{{ $query }}';
	@endif
</script>
<script src="{{ asset('js/sort.js') }}"></script>
@endpush

