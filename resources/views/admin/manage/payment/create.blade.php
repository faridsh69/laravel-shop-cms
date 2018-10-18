@extends('admin.dashboard')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<a href="/admin/manage/payment/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست دسته بندیها</a>
        <div class="half-seperate"></div>
		@if(isset($payment) )
		<form enctype="multipart/form-data" method="post" action="/admin/manage/payment/{{$payment->id}}" id="form">
			{{ method_field('PUT') }}
		@else
		<form enctype="multipart/form-data" method="post" action="/admin/manage/payment" id="form">
		@endif
			{{ csrf_field() }}
			<div class="panel {{ Request::segment(4) == 'edit' ? 'panel-info' :'panel-success'}} panel-default">
				<div class="panel-heading">
					@if(Request::segment(4) == 'edit')
						ویرایش دسته بندی شماره: 
						{{ $payment->id }}
						-
						{{ $payment->title }}
					@else
						ایجاد دسته بندی جدید
					@endif
					@if( isset($payment) )
						<input type="hidden" name="id" value="{{ $payment->id }}">
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
							<td width="190px"><b>عنوان دسته بندی *</b></div></td>
							<td><input type="text" name="title" class="form-control"
							value="{{ $payment->title or old('title') }}" required></td>
						</tr>
						<tr>
							<td>توضیحات</td>
							<td><textarea type="text" rows="2" name="description" class="form-control">{{ $payment->description or old('description') }}</textarea></td>
						</tr>
						<tr>
							<td><b>نوع *</b></td>
							<td>
							<select class="form-control" name="type">
								<option value="" disabled="">یک نوع انتخاب نمایید</option>
								@foreach($types as $type)
									<option value="{{ $type }}"
									{{ ( isset($payment) ? $payment->type : 0 ) == $type ? "selected" : ""}} >
										{{ $type }}
									</option>
								@endforeach
							</select>
							</td>
						</tr>
						<tr>
							<td width="190px">عنوان در موتورهای جستجو</div></td>
							<td><input type="text" name="meta_title" class="form-control"
							value="{{ $payment->meta_title or old('meta_title') }}">
						</tr>
						<tr>
							<td>توضیحات در موتورهای جستجو</div></td>
							<td><input type="text" name="meta_description" class="form-control"
							value="{{ $payment->meta_description or old('meta_description') }}"></td>
						</tr>
						<tr>
							<td>نمایش در سایت</td>
							<td>
							<div class="radio-style">
								<div class="radio-button col-xs-5 col-sm-3 col-md-2">
							    	<input type="radio" id="yes" name="status" value="1" 
							    	{{ ( isset($payment) ? $payment->status : 1 ) == 1 ? 'checked' : '' }}>
							    	<label for="yes"><span class="radio">بله</span> </label>
							    </div>
							    <div class="radio-button">
							    	<input type="radio" id="no" name="status" value="0" 
							    	{{ ( isset($payment) ? $payment->status : 1 ) == 0 ? 'checked' : '' }}>
							    	<label for="no"><span class="radio">خیر</span> </label>
							    </div>
							</div>
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


@endpush