@extends('admin.dashboard')
@section('title', 'ویژگی ها')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<a href="/admin/manage/feature/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست ویژگی ها</a>
        <div class="half-seperate"></div>
		@if(isset($feature) )
		<form enctype="multipart/form-data" method="post" action="/admin/manage/feature/{{$feature->id}}" id="form">
			{{ method_field('PUT') }}
		@else
		<form enctype="multipart/form-data" method="post" action="/admin/manage/feature" id="form">
		@endif
			{{ csrf_field() }}
			<div class="panel {{ Request::segment(4) == 'edit' ? 'panel-info' :'panel-success'}} panel-default">
				<div class="panel-heading">
					@if(Request::segment(4) == 'edit')
						ویرایش ویژگی شماره: 
						{{ $feature->id }}
						-
						{{ $feature->title }}
					@else
						ایجاد ویژگی جدید
					@endif
					@if( isset($feature) )
						<input type="hidden" name="id" value="{{ $feature->id }}">
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
								<button type="submit" class="btn btn-success btn-block">ذخیره اطلاعات</button>
								<div class="half-seperate"></div>
								<div class="help-block text-justify">
									برای ورود هر محصول شما نیاز دارید که ویژگی های آن محصول را بصورت دقیق وارد کنید تا به انتخاب مشتری کمک کند. <br> برای سهولت در این کار ویژگی هایی که مقدار آنها دایما در محصولات مختلف تکرار میشود را می توانید از نوع انتخابی بگذارید تا هر بار برای ورود آنها به شما مقادیر انتخابی را نمایش دهد و کافی باشد یکی از مقادیر را انتخاب کنید. <br> برای مقادیری که بصورت عددی هستند میتوانید واحد آنها را وارد نمایید. <br>
									همچنین هر ویژگی مختص یک دسته از محصولات است. مثلا برای دسته لباس سایز داریم - برای دسته موبایل حافظه داخلی - برای دسته ماشین تعداد سرنشین <br>
								</div>
								<div class="half-seperate"></div>
							</td>
						</tr>
						<tr>
							<td class="width-120"><b>عنوان ویژگی *</b></td>
							<td><input type="text" name="title" class="form-control"
							value="{{ $feature->title or old('title') }}" required></td>
						</tr>
						<tr>
							<td> <b>ویژگی دسته محصولات *</b></td>
							<td>
							<select class="form-control" name="category_id">
								<option value="">ندارد</option>
								@foreach($categories as $category)
									<option value="{{ $category->id }}"
									{{ ( isset($feature) ? $feature->category_id : 1 ) == $category->id ? "selected" : ""}} > 
										{{ $category->category ? $category->category->title.' >' : ''  }}  {{ $category->title }}
									</option>
								@endforeach
							</select>
							</td>
						</tr>
						<tr>
							<td> <b>نوع *</b></td>
							<td>
								<select class="form-control" onchange="check()" name="type" required="" id="typeInput">
									<option value="" disabled="">انتخاب نمایید</option>
									@foreach(\App\Models\Feature::$TYPES as $type)
										<option value="{{ $type }}"
										{{ ( isset($feature) ? $feature->type : 1 ) == $type ? "selected" : ""}} > 
											{{ $type }}
										</option>
									@endforeach
								</select>
							</td>
						</tr>

						<tr id="unitInput">
							<td>واحد</td>
							<td><input type="text" name="unit" class="form-control"
							value="{{ $feature->unit or old('unit') }}">
							
							</td>
						</tr>
						<tr id="optionsInput">
							<td>مقادیر قابل انتخاب</td>
							<td><input type="text" name="options" class="form-control"
							value="{{ $feature->options or old('options') }}">
							<small class="help-block">مقادیر را با + از هم جدا کنید</small>
							</td>
						</tr>
						
						<tr class="display-none">
							<td>
								تاثیر بر قیمت دارد ؟
							</td>
							<td>
								<input type="checkbox" name="price_affected" value="1">
							</td>
						</tr>
						<tr>
							<td>وضعیت</td>
							<td>
								<select class="form-control" name="status">
								@foreach(\App\Models\Feature::$STATUS as $key => $value)
									<option value='{{$key}}' 
									@if( isset($feature) )
									{{ $feature->status == $key ? 'selected' : '' }}
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
	<script>
		check();
		function check(){
			var typeInput = document.getElementById('typeInput');
			var optionsInput = document.getElementById('optionsInput');
			var unitInput = document.getElementById('unitInput');
			optionsInput.style.display = "none";
			unitInput.style.display = "none";
			if(typeInput.value == 'عدد'){
				unitInput.style.display = "table-row";
			}
			if(typeInput.value == 'انتخابی' || typeInput.value == 'چندمقداری'){
				optionsInput.style.display = "table-row";
			}
		}
	</script>

@endpush