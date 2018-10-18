<div class="container-fluid">
    @include('module.content.11')
    @include('module.content.6')

    @each('module.title.1', ['جدیدترین محصولات'], 'title')
	<div class="owl-carousel" id="new-product-slider">
        @each('common.product-box', $new_products, 'product')
    </div>
    <div class="seperate"></div>
    <div class="row">
        <div class="col-xs-6">
            @include('module.slider.1')
        </div>
        <div class="col-xs-6">
            @include('module.slider.2')
        </div>
    </div>
    <div class="seperate"></div>
    @each('module.title.1', ['محصولات تخفیف دار'], 'title')
    <div class="seperate"></div>
    <div class="row">
        <div class="owl-carousel" id="discount-product-slider">
            @each('common.product-box', $discount_products, 'product')
        </div>
    </div>
    <div class="seperate"></div>
    @each('module.title.1', ['اخبار'], 'title')
    <div class="seperate"></div>
    @include('module.news.4')
    <div class="seperate"></div>
    <div class="seperate"></div>
    @each('module.title.1', ['برندها'], 'title')
    @include('module.brand.2')
    <div class="seperate"></div>
    <div class="seperate"></div>
</div>
@push('script')
    <script>
        $(document).ready(function(){
            $('#new-product-slider').owlCarousel({
                rtl:true,
                margin:20,
                autoWidth:true,
                lazyLoad:true,
                autoplay:true,
                autoplayTimeout:5000,
                autoplaySpeed:3000,
                autoplayHoverPause:true,
                loop:true,
            });
            $('#discount-product-slider').owlCarousel({
                rtl:true,
                margin:20,
                autoWidth:true,
                lazyLoad:true,
                autoplay:true,
                autoplayTimeout:6000,
                autoplaySpeed:1300,
                autoplayHoverPause:true,
                loop:true,
            });
        });
    </script>
@endpush
