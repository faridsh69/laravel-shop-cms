@extends('layout.master')
@section('title', 'صفحه '. $page->title)
@section('description', 'صفحه' )
@section('image', $constant['logo'])
@section('container')
<div class="row">
	<div class="col-xs-12">
        <div class="half-seperate"></div>
			<div class="panel-boddy">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<div class="half-seperate"></div>
						<h1 class="page-header text-center">
							{{ $page->title }}
						</h1>
						<div class="half-seperate"></div>
						@if($page->image_id)
						<img src="{{ $page->image->src }}" class="img-responsive">
						@else
						<!-- <div class="text-center">
						تصویر آپلود نشده است!
						</div> -->
						@endif
						<!-- <div>
							<label>دسته بندی:</label>
							{{ $page->category ? $page->category->title : 'ندارد'}}
						</div> -->
						<!-- <div class="half-seperate"></div>
						تاریخ:
-						{{ \Nopaad\jDate::forge( $page->updated_at )->format(' %Y/%m/%d') }}
-						{{ \Nopaad\jDate::forge( $page->updated_at )->format(' %H:%M:%S') }} -->
						<div>
							{!! $page->content !!}
						</div>
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