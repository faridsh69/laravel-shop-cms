<div class="digi-background">
    <div class="container">
        @include('module.extra.go-top')
        <div class="seperate"></div>
        <div class="half-seperate"></div>
        <div class="row">
            <div class="col-xs-3">
                @include('module.baner.4')
                @include('module.baner.2')
                @include('module.baner.3')
                @include('module.baner.3')
                @include('module.news.1')
                
                <div class="half-seperate"></div>
            </div>
            <div class="col-xs-9">
                <div class="row">
                    <div class="col-xs-12 text-center">  
                        <div class="digi-card">       
                            @include('module.content.11')
                            @include('module.content.6')
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        @include('module.slider.3')
                    </div>
                </div>
                <div class="half-seperate"></div>
                
                <div class="digi-card">
                    <div class="digi-header">
                        جدیدترین محصولات
                    </div>
                    <div class="digi-body">
                        <div class="owl-carousel" id="new-product-slider">
                            @each('common.product-box', $new_products, 'product')
                        </div>
                    </div>
                </div>
                <div class="half-seperate"></div>
                
                <div class="digi-card">
                    <div class="digi-header">
                        محصولات تخفیف دار
                    </div>
                    <div class="digi-body">
                        <div class="owl-carousel" id="discount-product-slider">
                            @each('common.product-box', $discount_products, 'product')
                        </div>
                    </div>
                </div>
                <div class="half-seperate"></div>
                @include('module.content.3')
            </div>
        </div>
        @each('module.title.1', ['اخبار'], 'title')
        @include('module.news.3')
    </div>
    @include('module.brand.4')
    <div class="seperate"></div>
    <div class="seperate"></div>
    <div class="seperate"></div>
</div>


@push('script')
    <script>
        $(document).ready(function(){
            $('#new-product-slider').owlCarousel({
                rtl:true,
                margin:0,
                autoWidth:true,
                lazyLoad:true,
                autoplay:true,
                autoplayTimeout:5000,
                autoplaySpeed:3000,
                autoplayHoverPause:true,
                loop:true,
            });
            $('#special-product-slider').owlCarousel({
                rtl:true,
                margin:0,
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
                margin:0,
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

