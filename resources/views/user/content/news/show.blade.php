@extends('layout.master')
@section('title', 'خبر '. $news->title)
@section('description', 'خبر '. $news->title )
@section('image', $constant['logo'])
@section('container')
<div class="row">
	<div class="col-xs-12">
        <div class="half-seperate"></div>
			<div class="panel-boddy">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<h1 class="page-header larg-size">
							{{ $news->title }}
							<div class="one-third-seperate"></div>
						</h1>
						<div class="seperate"></div>
						<div class="text-center">
							<img src="{{ $news->base_image() }}" class="img-center">
						</div>
						<div class="half-seperate"></div>
						<label>دسته بندی:</label>
						{{ $news->category ? $news->category->title : 'ندارد'}}
						<div class="half-seperate"></div>
						تاریخ:
-						{{ \Nopaad\jDate::forge( $news->updated_at )->format(' %Y/%m/%d') }}
-						{{ \Nopaad\jDate::forge( $news->updated_at )->format(' %H:%M:%S') }}
						<hr>
						<div class="text-justify">
							{!! $news->content !!}
						</div>
						<div class="seperate"></div>
						<div class="seperate"></div>
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