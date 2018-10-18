@extends('admin.dashboard')
@section('title', 'نمایندگی ها')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<a href="{{ route('agent.index') }}" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست نمایندگیها</a>
        <div class="half-seperate"></div>
		 @if(isset($agent) )
		<form enctype="multipart/form-data" method="post" action="{{ route('agent.update', ['agent' => $agent]) }}" id="form">
			{{ method_field('PUT') }}
		@else
		<form enctype="multipart/form-data" method="post" action="{{ route('agent.index') }}" id="form">
		@endif
			{{ csrf_field() }}
			<div class="panel {{ Request::segment(4) == 'edit' ? 'panel-info' :'panel-success'}} panel-default">
				<div class="panel-heading">
					@if(Request::segment(4) == 'edit')
						ویرایش نمایندگی شماره: 
						{{ $agent->id }}
						-
						{{ $agent->title }}
					@else
						ایجاد نمایندگی جدید
					@endif
					@if( isset($agent) )
						<input type="hidden" name="id" value="{{ $agent->id }}">
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
							<td>توضیح نمایندگی</td>
							<td>
								<textarea type="text" rows="2" name="description" class="form-control"
								>{{ $agent->description or old('description') }}</textarea>

							</td>
						</tr>
						<tr>
						<div class="form-horizontal" style="padding: 20px;">
							<div class="form-group">
							    <label for="display_name" class="col-sm-2 control-label">نام و نام‌خانوادگی *</label>
							    <div class="col-sm-4">
							      	<input type="text" class="form-control" id="display_name" name="display_name" value="{{ $agent->display_name or old('display_name') }}" required>
							    </div>
							    <label for="phone" class="col-sm-2 control-label">شماره همراه *</label>
							    <div class="col-sm-4">
							      	<input type="text" class="form-control" id="phone" name="phone" value="{{ $agent->phone or old('phone') }}" required>
							    </div>
						  	</div>
						  	<div class="form-group">
							    <label for="sabet_phone" class="col-sm-2 control-label">شماره تلفن ثابت</label>
							    <div class="col-sm-4">
							      	<input type="text" class="form-control" id="sabet_phone" name="sabet_phone" value="{{ $agent->sabet_phone or old('sabet_phone') }}">
							    </div>
							    <label for="postal_code" class="col-sm-2 control-label">کد پستی</label>
							    <div class="col-sm-4">
							      	<input type="text" class="form-control" id="postal_code" name="postal_code"	value="{{ $agent->postal_code or old('postal_code') }}">
							    </div>
						  	</div>
						  	<div class="form-group">
							    <label for="province" class="col-sm-2 control-label">استان *</label>
							    <div class="col-sm-4">
									<select id="province" onchange="changeProvince()" class="form-control" name="province">
										@foreach(\Config::get('constants.provinces') as $id => $value)
										<option value="{{ $id }}" 
											@if($id == 8) 
												selected 
											@endif
											>
											{{ $value }}
										</option>
										@endforeach
									</select>		    
								</div>
							    <label for="city" class="col-sm-2 control-label">شهر</label>
							    <div class="col-sm-4">
							    	<select id="city" class="form-control" name="city">
									</select>
							    </div>
						  	</div>
						  	<div class="form-group">
							    <label for="address" class="col-sm-2 control-label">آدرس پستی</label>
							    <div class="col-sm-10">
							    	<textarea type="text" id="address" class="form-control" name="address" required>{{ $agent->real_address or old('address') }}</textarea>
							    </div>
						  	</div>
						</div>
						</tr>
						<tr>
							<td width="190px"><b> برند</b></div></td>
							<td>
								<select class="form-control" name="brand_id" id="brand_id">
								@foreach(\App\Models\Brand::select('id', 'title')->get() as $brand)
									<option value='{{ $brand->id }}' 
									@if( isset($agent) )
									{{ $agent->brand_id == $brand->id ? 'selected' : '' }}
									@else
									{{ old('brand_id') == $brand->id ? 'selected' : '' }}
									@endif
									> {{ $brand->title }} </option> 
								@endforeach
								</select>
							</td>
						</tr>		
						<tr>
							<td>وضعیت</td>
							<td>
								<select class="form-control" name="status">
								@foreach(\App\Models\Agent::$STATUS as $key => $value)
									<option value='{{$key}}' 
									@if( isset($agent) )
									{{ $agent->status == $key ? 'selected' : '' }}
									@else
									{{ old('status') == $key ? 'selected' : '' }}
									@endif
									> {{$value}} </option> 
								@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td>آپلود عکس 
							<div class="help-block">حجم تصویر حداکثر ۴ مگابایت باشد.</div>
							</td>
							<td>
								<input id="file" type="file" accept='image/*' />
								<div class="half-seperate"></div>
								<button id="cropbutton" type="button" class="btn btn-info btn-xs">
									برش عکس
								</button>
								<div class="half-seperate"></div>
								<div id="views"></div>
								<div class="text-center">
								<img id='preview' class="img-responsive img-thumbnail">
								@if(isset($agent))
									@if($agent->image)
										<img src="{{$agent->image->src100 }}" class="img-responsive">
											<a href="/admin/delete-image/{{$agent->image->id}}" class="btn btn-xs btn-danger pull-right">جذف <i class="fa fa-remove"></i> </a>

									@else
									@endif
								@endif
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
<script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-alpha.2/classic/ckeditor.js"></script>
<script type="text/javascript">
	
	ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => {
        // console.log( editor );
    } );

</script>

<script type="text/javascript">
select = document.getElementById('city');
changeProvince = function(){
	var province = $("#province")[0].value;
	console.log(province);
	$.get('/admin/change-province/'+ province, function( data ) {
	  	for (var i=0; i<100; i++){
     		select.remove(0);
	  	}
		data.forEach(function(item, key){
		    var opt = document.createElement('option');
		    opt.value = item;
		    opt.innerHTML = item;
		    select.appendChild(opt);				
		});
	});
};
changeProvince();
</script>
@endpush
