<div class="container-fluid">
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 text-center">         
            <h1 class="bold page-header hug-size">
                <img src="{{ asset('upload/images/header_holoo.png') }}" class="img-responsive">
            </h1>
        </div>
    </div>
    <div class="seperate"></div>
    <div class="display-none">
        {{ $product = $new_products[0] }}
    </div>
    <div class="text-center">
        <a href="/product/{{$product->id}}">
        <div class="product-image-container">
            <img src="{{ asset($product->base_image() ) }}" class="product-image" 
                style="max-height: 400px;width: auto;color: red;">
        </div>
        <div class="seperate"></div>
        <p class="product-name" style="font-size: 22px;">
            {{ $product->title }}
        </p>
        <div class="one-third-seperate"></div>
        @if($product->discount_price)
            <p class="product-price">
            {{ number_format($product->discount_price) }} تومان
            </p>
            <!-- <p class="product-discount">
                <span >
                    {{ number_format($product->price) }}
                </span>
            </p> -->
        @else
            <p class="product-price">
            {{ number_format($product->price) }} تومان
            </p>
        @endif
        </a>
    </div>
    <div class="seperate"></div>
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
    <div class="seperate"></div>
    @each('module.title.1', ['اخبار'], 'title')
    <div class="seperate"></div>
    @include('module.news.4')
    <div class="seperate"></div>

    @include('module.content.6')

    <div class="seperate"></div>
    <div class="seperate"></div>
    <div class="seperate"></div>
</div>