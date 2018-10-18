<div class="product-features">
	<label>{{ $feature->title }}:</label>
	@if($feature->type == \App\Models\Feature::TYPE_BOOLEAN)
		@if($feature->pivot->data)
			<i class="fa fa-check"></i>
		@else
			<i class="fa fa-close"></i>
		@endif
	@else
		<span>
			{{ $feature->pivot->data }}
			{{ $feature->unit }}
		</span>
	@endif
	<div class="half-seperate"></div>
</div>