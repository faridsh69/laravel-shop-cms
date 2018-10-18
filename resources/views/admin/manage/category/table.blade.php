<div id="{{ $categories[0]->type }}" class="tab-pane fade 
		{{ $categories[0]->type == 'محصول' ? 'in active' : '' }} ">
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
				<a class="inline-flex" sort="description"> توضیحات </a>
			</th>
			<th class="hidden-xs">
				<a class="inline-flex" sort="type"> نوع </a>
			</th>
			<th>
				<a class="inline-flex" sort="category_id"> مادر </a>
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
			@if( count($categories) == 0 )
			<tr>
				<td colspan="10">
					<div class="alert">
						موردی یافت نشد !
					</div>
				</td>
			</tr>
			@endif
			@foreach($categories as $category)
			<tr>
				<td class="text-center width-50px" >
					{{ $category->id }}
				</td>
				<td>
					{{ $category->title}}
				</td>
				<td class="hidden-xs description-div">
					{!! $category->description !!}
				</td>
				<td class="hidden-xs">
					{{ $category->type}}
				</td>
				<td class="width-80px">
					@if($category->category && $category->category->category )
					{{ $category->category ? $category->category->category->title. ' -> ' : '-'}}
					@endif
					{{ $category->category ? $category->category->title : '-'}}
				</td>
				<td class="hidden-xs">
					{{ $category->user ? $category->user->first_name : '-'}}
					{{ $category->user ? $category->user->last_name : ''}}
				</td>
				<td class="min-width-110">
					<select class="form-control" 
						onchange="statusChanged(this, {{ $category->id }}, 'category')">
						@foreach(\App\Models\Category::$STATUS as $key => $value)
						<option value='{{$key}}' {{ $category->status == $key ? 'selected' : '' }}> {{$value}} </option> 
						@endforeach
					</select>
				</td>
				<td class="width-80px">
					<a href="/admin/manage/category/{{ $category->id }}">
						<span class="glyphicon glyphicon-eye-open"></span>
						مشاهده
					</a>
					<div class="one-third-seperate"></div>
					<a href="/admin/manage/category/{{ $category->id }}/edit">
						<span class="glyphicon glyphicon-pencil"></span>
						ویرایش
					</a>
					<!-- <div class="one-third-seperate"></div>
					<form action="/admin/manage/category/{{ $category->id }}" method="POST" class="display-inline">
					    {{ method_field('DELETE') }}
					    {{ csrf_field() }}
						<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> حذف</button>
					</form> -->
				</td>
			</tr>
			@endforeach
		</tbody>
		</table>
	</div>
</div>