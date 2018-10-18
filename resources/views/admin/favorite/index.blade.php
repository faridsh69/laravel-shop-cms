@extends('admin.dashboard')
@section('title', 'مورد علاقه ها')
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
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				مورد علاقه
			</div>
			<div class="half-seperate"></div>
            <div class="row">
                <div class="col-xs-12">
			         @each('common.product-box', $favorite_products, 'product')
                </div>
            </div>
		</div>
	</div>
</div>
@endsection
@push('script')



@endpush