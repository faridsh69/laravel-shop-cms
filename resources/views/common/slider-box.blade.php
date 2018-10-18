<div class="text-center">
	<div>
		<h4 class="slider-title">
			{{ $baner->title }}
		</h4>
		<img src="{{ asset($baner->base_image() ) }}" alt="{{ $baner->title }}"  class="baner-index">
		<h4>
			<small>
				{{ $baner->description }}
			</small>
		</h4>
	</div>
</div>