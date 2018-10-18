<form class="form-inline" method="GET">
  	<div class="form-group">
    	<label for="name">نام خانوادگی:</label>
   	 	<input type="text" class="form-control input-sm" id="name" name="name">
  	</div>
  	<div class="form-group">
    	<label for="phone">تلفن: </label>
    	<input type="text" class="form-control input-sm" id="phone" name="phone">
  	</div>
  	<div class="form-group">
    	<label for="status">وضعیت: </label>
    	<select class="form-control" name="status" id="status">
			<option value="">همه</option>
			@foreach(\App\Models\User::$STATUS as $key => $value)
				<option value="{{ $key }}"> 
					{{ $value }}
				</option>
			@endforeach
		</select>
  	</div>
  	<div class="form-group">
    	<label for="role">نقش کاربر: </label>
    	<select class="form-control" name="role" id="role">
			<option value="">همه</option>
			@foreach(\App\Models\Role::get() as $role)
				<option value="{{ $role->id }}"
					{{ Request::input('role') == $role->id ? "selected" : ""}} >
					{{ $role->description }}
				</option>
			@endforeach
		</select>
  	</div>
  	<button type="submit" class="btn btn-default input-sm">جستجو</button>
  	<span class="margin-right-10">
		{{ $users->total() }} مورد یافت شد.
	</span>
</form>