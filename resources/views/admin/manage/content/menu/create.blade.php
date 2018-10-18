@extends('admin.dashboard')
@section('title', 'منو ها')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<a href="/admin/manage/content/menu/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست منوها</a>
        <div class="half-seperate"></div>
		@if(isset($menu) )
		<form enctype="multipart/form-data" method="post" action="/admin/manage/content/menu/{{$menu->id}}" id="form">
			{{ method_field('PUT') }}
		@else
		<form enctype="multipart/form-data" method="post" action="/admin/manage/content/menu" id="form">
		@endif
			{{ csrf_field() }}
			<div class="panel {{ Request::segment(4) == 'edit' ? 'panel-info' :'panel-success'}} panel-default">
				<div class="panel-heading">
					@if(Request::segment(4) == 'edit')
						ویرایش منو شماره: 
						{{ $menu->id }}
						-
						{{ $menu->title }}
					@else
						ایجاد منو جدید
					@endif
					@if( isset($menu) )
						<input type="hidden" name="id" value="{{ $menu->id }}">
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
							<td class="width-120"><b>عنوان منو *</b></td>
							<td><input type="text" name="title" class="form-control"
							value="{{ $menu->title or old('title') }}" required></td>
						</tr>
						<tr>
							<td><b>آدرس *</b></td>
							<td><input type="text" name="url" class="form-control ltr"
							value="{{ $menu->url or old('url') }}" required></td>
						</tr>
						<tr>
							<td>منو مادر</td>
							<td>
							<select class="form-control" name="menu_id">
								<option value="">ندارد</option>
								@foreach(\App\Models\Menu::get() as $menu_item)
									<option value="{{ $menu_item->id }}"
									{{ ( isset($menu_item) ? $menu_item->menu_id : 1 ) == $menu_item->id ? "selected" : ""}} > 
										{{ $menu_item->title }}
									</option>
								@endforeach
							</select>
							</td>
						</tr>
						<tr>
							<td><b>موقعیت*</b></td>
							<td>
								<select class="form-control" name="location">
								@foreach(\App\Models\Menu::$LOCATION as $key => $value)
									<option value='{{$key}}' 
									@if( isset($menu) )
									{{ $menu->location == $key ? 'selected' : '' }}
									@else
									{{ old('location') == $key ? 'selected' : '' }}
									@endif
									> {{$value}} </option> 
								@endforeach
								</select>
							</td>
						</tr>	
						<tr>
							<td>وضعیت</td>
							<td>
								<select class="form-control" name="status">
								@foreach(\App\Models\Menu::$STATUS as $key => $value)
									<option value='{{$key}}' 
									@if( isset($menu) )
									{{ $menu->status == $key ? 'selected' : '' }}
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


@endpush