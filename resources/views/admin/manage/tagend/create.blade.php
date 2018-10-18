@extends('admin.dashboard')
@section('title', 'زیر فاکتور ها')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<a href="{{ route('tagend.index') }}" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست زیر فاکتورها</a>
        <div class="half-seperate"></div>
		 @if(isset($tagend) )
		<form enctype="multipart/form-data" method="post" action="{{ route('tagend.update', ['tagend' => $tagend]) }}" id="form">
			{{ method_field('PUT') }}
		@else
		<form enctype="multipart/form-data" method="post" action="{{ route('tagend.index') }}" id="form">
		@endif
			{{ csrf_field() }}
			<div class="panel {{ Request::segment(4) == 'edit' ? 'panel-info' :'panel-success'}} panel-default">
				<div class="panel-heading">
					@if(Request::segment(4) == 'edit')
						ویرایش زیر فاکتور شماره: 
						{{ $tagend->id }}
						-
						{{ $tagend->title }}
					@else
						ایجاد زیر فاکتور جدید
					@endif
					@if( isset($tagend) )
						<input type="hidden" name="id" value="{{ $tagend->id }}">
					@endif
				</div>
				<div class="half-seperate"></div>
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
	            <div class="one-third-seperate"></div>
            	<div class="table-responsive">
					<table class="table table-striped">
						<tr>
							<td colspan="20">
								<div class="col-xs-12">
									<button type="submit" class="btn btn-success btn-block">ذخیره اطلاعات</button>
								</div>
							</td>
						</tr>
						<tr>
							<td class="width-120"><b>عنوان زیر فاکتور *</b></td>
							<td><input type="text" name="title" class="form-control"
							value="{{ $tagend->title or old('title') }}" required></td>
						</tr>
						
						<tr>
							<td><b>مقدار *</b></td>
							<td><input type="number" name="value" class="form-control"
							value="{{ $tagend->value or old('value') }}" required></td>
						</tr>
						<tr>
							<td>افزودن به مبلغ فاکتور یا کاهش</td>
							<td>
								<select class="form-control" name="sign" required>
								@foreach(\App\Models\Tagend::$SIGNES as $key => $value)
									<option value='{{$key}}' 
									@if( isset($tagend) )
									{{ $tagend->sign == $key ? 'selected' : '' }}
									@else
									{{ old('sign') == $key ? 'selected' : '' }}
									@endif
									> {{$value}} </option> 
								@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td>درصد یا مبلغ ثابت</td>
							<td>
								<select class="form-control" name="type" required>
								@foreach(\App\Models\Tagend::$TYPES as $key => $value)
									<option value='{{$key}}' 
									@if( isset($tagend) )
									{{ $tagend->type == $key ? 'selected' : '' }}
									@else
									{{ old('type') == $key ? 'selected' : '' }}
									@endif
									> {{$value}} </option> 
								@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td>توضیح زیر فاکتور</td>
							<td>
								<textarea class="ckeditor" name="description">{{ $tagend->description or old('description') }}</textarea>
							</td>
						</tr>
						<tr>
							<td>وضعیت</td>
							<td>
								<select class="form-control" name="status">
								@foreach(\App\Models\Tagend::$STATUS as $key => $value)
									<option value='{{$key}}' 
									@if( isset($tagend) )
									{{ $tagend->status == $key ? 'selected' : '' }}
									@else
									{{ old('status') == $key ? 'selected' : '' }}
									@endif
									> {{$value}} </option> 
								@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="20">
								<div class="col-xs-12">
									<button type="submit" class="btn btn-success btn-block">ذخیره اطلاعات</button>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="seperate"></div>
@endsection
@push('script')
<script src="{{ asset('js/ckeditor4/ckeditor.js') }}"></script>
@endpush