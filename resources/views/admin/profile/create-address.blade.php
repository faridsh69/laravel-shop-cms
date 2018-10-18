<form enctype="multipart/form-data" action="/admin/profile/address" method="POST">
	{{ csrf_field() }}
	<div class="panel panel-success">
		<div class="panel-heading">ثبت آدرس جدید
		</div>
		<div class="panel-body">
	    	<div class="form-horizontal">
				<div class="form-group">
				    <label for="display_name" class="col-sm-2 control-label">نام و نام‌خانوادگی *</label>
				    <div class="col-sm-4">
				      	<input type="text" class="form-control" id="display_name" name="display_name" value="{{Auth::user()->first_name}} {{Auth::user()->last_name}}" required>
				    </div>
				    <label for="phone" class="col-sm-2 control-label">شماره همراه *</label>
				    <div class="col-sm-4">
				      	<input type="text" class="form-control" id="phone" name="phone" value="{{Auth::user()->phone}} " required minlength="11" maxlength="11">
				    </div>
			  	</div>
			  	<div class="form-group">
				    <label for="sabet_phone" class="col-sm-2 control-label">شماره تلفن ثابت</label>
				    <div class="col-sm-4">
				      	<input type="text" class="form-control" id="sabet_phone" name="sabet_phone" value="{{ old('sabet_phone') }}">
				    </div>
				    <label for="postal_code" class="col-sm-2 control-label">کد پستی</label>
				    <div class="col-sm-4">
				      	<input type="text" class="form-control" id="postal_code" name="postal_code"	value="{{ old('postal_code') }}">
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
				      	<!-- <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required> -->
				    </div>
			  	</div>
			  	<div class="form-group">
				    <label for="address" class="col-sm-2 control-label">آدرس پستی</label>
				    <div class="col-sm-10">
				    	<textarea rows="3" type="text" id="address" class="form-control" name="address" required>{{ old('address') }}</textarea>
				    </div>
			  	</div>
			  	<div class="form-group">
					<div class="col-sm-12">
						<button class="btn btn-success btn-block" type="submit"> ذخیره آدرس</button>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 text-center">
						<h4>آدرس را روی نقشه مشخص کنید.</h4>
						<div id="map"></div>
						<!-- <div class="seperate"></div>
						<div>
							<div class="col-sm-4">
						    	<input id="address" type="textbox" value="تهران" class="form-control">
						    </div>
						    <input type="button" value="جستجو" onclick="codeAddress()" class="btn btn-default">
					  	</div> -->
						<div class="col-sm-1">
							<input id="latitude" type="hidden" value="latitude" name="latitude" class="form-control">
						</div>
						<div class="col-sm-1">
							<input id="longitude" type="hidden" value="longitude" name="longitude" class="form-control">
						</div>
					</div>
					<div class="seperate"></div>
				</div>
			</div>
		</div>
	</div>
</form>
@push('script')
<script type="text/javascript">
select = document.getElementById('city');
changeProvince = function(){
	var province = $("#province")[0].value;
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
