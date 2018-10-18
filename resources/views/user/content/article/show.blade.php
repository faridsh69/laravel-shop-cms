@extends('layout.master')
@section('title', 'مقاله '. $article->title)
@section('description', 'مقاله' )
@section('image', $constant['logo'])
@section('container')
<div class="row">
	<div class="col-xs-12">
        <div class="half-seperate"></div>
			<div class="panel-boddy">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<div class="seperate"></div>
						مقاله شماره {{ $article->id }}
						@if($article->image_id)
						<img src="{{ $article->image->src }}" class="img-responsive">
						@else
						<div class="seperate"></div>
						<!-- <div class="text-center">
						تصویر آپلود نشده است!
						</div> -->
						@endif
						<div class="half-seperate"></div>
						<div class="bold">
							
							عنوان: 
							{{ $article->title }}
							<div class="one-third-seperate"></div>
							
						</div>
						<div class="half-seperate"></div>
						<div>
							<label>دسته بندی:</label>
							{{ $article->category ? $article->category->title : 'ندارد'}}
						</div>
						<div class="half-seperate"></div>
						تاریخ:
-						{{ \Nopaad\jDate::forge( $article->updated_at )->format(' %Y/%m/%d') }}
-						{{ \Nopaad\jDate::forge( $article->updated_at )->format(' %H:%M:%S') }}
						<hr>
						<div>
							<label>متن مقاله:</label>
							{{ $article->content}}
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