<div class="owl-carousel" id="right-slider">
    @each('common.slider-box', $baners_right_slider, 'baner')
</div>

@push('script')
<script>
	$(document).ready(function(){
		$('#right-slider').owlCarousel({
	        rtl:true,
	        items:1,
	        // autoWidth:true,
	        // margin:20,
	        lazyLoad:true,
	        autoplay:true,
	        autoplayTimeout:6000,
	        autoplaySpeed:1900,
	        autoplayHoverPause:true,
	        loop:true,
	    });
    });
</script>
@endpush