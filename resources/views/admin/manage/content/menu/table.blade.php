<div id="{{ $menu_type['key'] }}" class="tab-pane fade 
		{{ $menu_type['key'] == 'header' ? 'in active' : '' }} ">
	<div class="reponsive-table">
		<table class="table table-striped">
		<thead>
		<tr>
			<th>
				<a class="inline-flex" sort="id"> شمارنده </a>
			</th>
			<th>
				<a class="inline-flex" sort="title"> عنوان </a>
			</th>
			<th class="hidden-xs">
				<a class="inline-flex" sort="description"> آدرس </a>
			</th>
			<th>
				<a class="inline-flex" sort="location"> مکان </a>
			</th>
			<th class="hidden-xs">
				<a class="inline-flex" sort="menu_id"> مادر </a>
			</th>
			<th class="hidden-xs">
				<a class="inline-flex" sort="user_id"> نویسنده </a>
			</th>
			<th>
				<a class="inline-flex" sort="status"> وضعیت </a>
			</th>
			<th>
				عملیات
			</th>
		</tr>
		</thead>
		<tbody>
			@if( count($menu_type['menus']) == 0 )
			<tr>
				<td colspan="10">
					<div class="alert">
						موردی یافت نشد !
					</div>
				</td>
			</tr>
			@endif
			@foreach($menu_type['menus'] as $menu)
			<tr>
				<td class="text-center width-50px" >
					{{ $menu->id }}
				</td>
				<td>
					{{ $menu->title}}
				</td>
				<td class="ltr hidden-xs">
					{{ $menu->url }}
				</td>
				<td>
					{{ $menu->location_translate() }}
				</td>
				<td class="width-80px hidden-xs">
					@if($menu->menu && $menu->menu->menu )
					{{ $menu->menu ? $menu->menu->menu->title. ' -> ' : '-'}}
					@endif
					{{ $menu->menu ? $menu->menu->title : '-'}}
				</td>
				<td class="hidden-xs">
					{{ $menu->user ? $menu->user->first_name : '-'}}
					{{ $menu->user ? $menu->user->last_name : ''}}
				</td>
				<td class="min-width-110">
					<select class="form-control" 
						onchange="statusChanged(this, {{ $menu->id }}, 'menu')">
						@foreach(\App\Models\Menu::$STATUS as $key => $value)
						<option value='{{$key}}' {{ $menu->status == $key ? 'selected' : '' }}> {{$value}} </option> 
						@endforeach
					</select>
				</td>
				<td class="width-80px">
					<a href="/admin/manage/content/menu/{{ $menu->id }}">
						<span class="glyphicon glyphicon-eye-open"></span>
						مشاهده
					</a>
					<div class="one-third-seperate"></div>
					<a href="/admin/manage/content/menu/{{ $menu->id }}/edit">
						<span class="glyphicon glyphicon-pencil"></span>
						ویرایش
					</a>
				</td>
			</tr>
			@endforeach
		</tbody>
		</table>
	</div>
</div>