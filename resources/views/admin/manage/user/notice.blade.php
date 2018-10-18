<!-- @extends('admin.dashboard')
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
	@if ($errors->all())
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul class="list-unstyled">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		@include('admin.manage.user.search')
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		@include('admin.manage.user.email')
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		@include('admin.manage.user.sms')
	</div>
</div>
@endsection

 -->