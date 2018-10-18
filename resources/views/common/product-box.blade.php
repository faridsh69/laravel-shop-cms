<div class="box-small">
	<a href="/product/{{$product->id}}">
		<img src="{{ asset($product->base_image() ) }}" alt="عکس {{ $product->title }}">
		<div class="half-seperate"></div>
		<p>
			{{ $product->title }}
		</p>
		<div class="half-seperate"></div>
		@if($product->discount_price)
			<p class="price">
				{{ number_format($product->discount_price) }} 
				<span class="toman">تومان</span>
			</p>
			<div class="one-third-seperate"></div>
			<p class="price-discount">
				<del>
					{{ number_format($product->price) }}
					<span class="toman">تومان</span>
				</del>
			</p>
		@else
			<p class="price">
				{{ number_format($product->price) }} 
				<span class="toman">تومان</span>
			</p>
		@endif
	</a>
</div>