<div class="panel panel-info">
	<div class="panel-heading">
		آدرس های شما
	</div>
	<div class="panel-body">
		@if( count(\Auth::user()->addresses) == 0 )
			<div class="help-block">  تاکنون وارد نکره‌اید. </div>
		@else
		<div class="half-seperate"></div>
		<ol>
			@foreach(\Auth::user()->addresses as $address)
				<div class="col-sm-5">
					<label class="display-inline">تغییر وضعیت: </label>
					<select class="form-control display-inline" 
						onchange="statusChanged(this, {{ $address->id }}, 'brand')">
						@foreach(\App\Models\Address::$STATUS as $key => $value)
						<option value='{{$key}}' {{ $address->status == $key ? 'selected' : '' }}> {{$value}} </option> 
						@endforeach
					</select>
				</div>
			<li>
				@each('common.address-box', [$address], 'address')
			</li>
			@endforeach
		</ol>
		@endif
	</div>
</div>
