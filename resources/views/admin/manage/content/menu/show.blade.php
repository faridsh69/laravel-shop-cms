@extends('admin.dashboard')
@section('title', 'منو ها')

@section('content')
<div class="row">
	<div class="col-xs-12">
        <a href="/admin/manage/content/menu/create" class="btn btn-success">
        	<span class="glyphicon glyphicon-plus"></span> 
        	ایجاد منو جدید</a>
    	<a href="/admin/manage/content/menu/" class="btn btn-primary">
			<span class="glyphicon glyphicon-list"></span>
			لیست منوها</a>
        <div class="half-seperate"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				منو شماره {{ $menu->id }}
				<a href="/admin/manage/content/menu/{{$menu->id}}/edit" class="btn btn-info btn-xs">
        			<span class="glyphicon glyphicon-pencil"></span>ویرایش</a>
        		<form action="/admin/manage/content/menu/{{ $menu->id }}" method="POST" class="display-inline">
				    {{ method_field('DELETE') }}
				    {{ csrf_field() }}
					<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> حذف</button>
				</form>
			</div>
			<div class="panel-boddy">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<div class="half-seperate"></div>
						<div class="seperate"></div>
						<div class="bold">
							<div class="one-third-seperate"></div>
							عنوان: 
							{{ $menu->title }}
							<div class="one-third-seperate"></div>
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>آدرس: </label>
							{{ $menu->url }}
						</div>
						<div class="half-seperate"></div>
						<div class="half-seperate"></div>
						<div>
							<label>مادر: </label>
							@if($menu->menu)
								- {{ $menu->menu->title }} -
								<a href="/admin/manage/content/menu/{{ $menu->menu->id }}">لینک</a>
							@else
								-
							@endif
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>مکان:</label>
							{{ $menu->location_translate() }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>وضعیت:</label>
							{{ $menu->status_translate() }}
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>نویسنده:</label>
							{{ $menu->user ? $menu->user->first_name : ''}}
							{{ $menu->user ? $menu->user->last_name : ''}}
							-
							آیدی کاربری:
							{{ $menu->user ? $menu->user->id : ''}}
						</div>
						<div class="half-seperate"></div>
						تاریخ آخرین تغییر:
						<br>
						{{ \Nopaad\jDate::forge( $menu->updated_at )->format(' %Y/%m/%d') }}
						<br>
						{{ \Nopaad\jDate::forge( $menu->updated_at )->format(' %H:%M:%S') }}
						<hr>
						@if(count($menu->menus) > 0)
							<hr>
							<h4>
							زیر شاخه ها:
							</h4>
							@foreach($menu->menus as $item)
							<div class="simple-box">
								<label><b> عنوان: </b></label>
								{{ $item->title}}
								<div class="half-seperate"></div>
								<a href="/admin/manage/menu/{{ $item->id }}">لینک </a>
								<div class="half-seperate"></div>
								<label><b>توضیح:</b></label>
								{{ $item->content}}
							</div>
							<div class="seperate"></div>
							@endforeach
						@endif
						<div class="seperate"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('script')



@endpush