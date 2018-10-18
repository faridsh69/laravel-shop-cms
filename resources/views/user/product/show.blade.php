@extends('layout.master')
@section('title', $product->title)
@section('description', $product->description )
@section('image', $product->base_image() )

@push('style')
    <style>
        .canvass {
            position:absolute;
            width: 170px;
            height: 170px;
            overflow:hidden;
            border : 1px solid #eee;
            border-radius: 50%;
            display: none;
        }
        .zoomedimage {
            position: absolute;
        }
    </style>
@endpush

@section('container-fluid')
<div class="background-product-show">
<div class="seperate"></div>
<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            @if($product->category)
            <li>{{ $product->category->title }}</li>
            @endif
            <li class="active">{{ $product->title }}</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="card-pro card-pro-price padding-20">
            @if( !$product->discount_price )
            <span class="big-size">
                <i class="fa fa-dollar"></i>
                قیمت:
                {{ number_format($product->price) }}
                تومان
            </span>
            @else
            <span class="">
                قیمت:
                <del>
                {{ number_format($product->price) }}
                </del>
                تومان
            </span>
            <span class="big-size margin-right-10">
                <i class="fa fa-dollar"></i>
                قیمت با تخفیف:
                {{ number_format($product->discount_price) }}
                تومان
            </span>
            @endif
            <div class="product-buttons-detail">
                <form class="form-inline inline-block" method="post" action="/basket/count/view">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="hidden" class="form-control input-sm" name="count" value="1" >
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button class="btn btn-success btn-sm" type="submit">
                            <span class="glyphicon glyphicon-shopping-cart"></span> 
                            افزودن به سبد خرید
                        </button>
                    </div>
                </form>

                <a href="/product/comparison/{{ $product->id }}">
                    <i class="fa fa-balance-scale width-20"></i>
                    مقایسه
                </a>
                <a href="/product/share/{{ $product->id }}">
                    <i class="fa fa-share-alt width-20"></i>
                    اشتراک گذاری
                </a>
                <a href="javascript::void(0)" onclick="window.print()">
                    <i class="fa fa-print width-20"></i>
                    پرینت
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
            <div class="alert alert-{{ $msg }} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul class="list-unstyled">
                    <li>{{ Session::get('alert-' . $msg) }}</li>
                </ul>
            </div>
            @endif
        @endforeach
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card-pro image-box shatel-css">
            <div class="card-header">
                <span>
                گالری تصویر
                </span>
            </div>
            <div class="gallery">
                @include('common.gallery-box')
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card-pro shatel-css">
            <div class="card-header">
                <h1>
                    {{ $product->title }}
                </h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        @each('common.feature-box', $product->features, 'feature')
                        <p>
                            <i class="fa fa-2x fa fa-bookmark"></i>
                            توضیحات:
                            {!! $product->description !!}
                        </p>
                        <hr>
                        <form class="form-inline" method="post" action="/basket/count/view">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <span >افزودن این تعداد محصول به سبد خرید: </span>
                                <input type="number" class="form-control input-sm" id="count" name="count" 
                                    value="1" style="width: 70px;">
                            </div>
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button class="btn btn-success btn-sm" type="submit">
                                <span class="glyphicon glyphicon-shopping-cart"></span> 
                                افزودن به سبد خرید
                            </button>
                        </form>
                        <div class="help-block">
                            تغییرات را در سبد خرید میتوانید مشاهده نمایید.
                        </div>
                        <div class="seperate"> </div>
                        <div class="seperate"> </div>
                        <p class="big-size bold text-center page-header">محصولات مشابه</p>
                        @if( count($related_products) == 0)
                            <div class="alert alert-warning">محصولی یافت نشد!</div>
                        @endif
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="owl-carousel" id="related-product-slider">
                                    @each('common.product-box', $related_products, 'product')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 card-pro">
        <!-- <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#comment"> </a></li>
          <li><a data-toggle="tab" href="#mazaya">بررسی تخصصی محصول</a></li>
          <li><a data-toggle="tab" href="#moshabeh">محصولات مشابه</a></li>
          <li><a data-toggle="tab" href="#gallery">گالری تصاویر</a></li>
        </ul> -->

        <div class="tab-content">
            <div id="comment" class="tab-pane fade in active">
                <h3 class="page-header text-center">
                نظرات کاربران
                </h3>
                <div class="seperate"></div>
                @if ($errors->all())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul class="list-unstyled">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                    <div class="alert alert-{{ $msg }} alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <ul class="list-unstyled">
                            <li>{{ Session::get('alert-' . $msg) }}</li>
                        </ul>
                    </div>
                    @endif
                @endforeach
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        این محصول را می پسندید؟
                        <like-product :product_id="{{ $product->id }}"></like-product>
                    </div>
                </div>
                <div class="row">
                @foreach($comments as $comment)
                    <div class="col-md-10 col-md-offset-1">
                        <div class="half-seperate"></div>
                        <div class="media comment-media">
                            <div class="media-left">
                                <img src="{{ asset($constant['default_image_user']) }}" class="media-object"
                                     style="width:50px">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading black-color">{{ $comment->user->name() }}</h4>
                                <span>
                                    {{ \Nopaad\jDate::forge($comment->created_at)->format('d\m\Y - H:d') }}
                                </span>
                                <div class="seperate"></div>
                                <p>{{ $comment->comment }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
                <div class="seperate"></div>
                <div class="seperate"></div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <form method="post" action="/product/comment">
                            {{ csrf_field() }}
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <p class="big-size">
                                ارسال نظر جدید

                            </p>
                            <div class="seperate"></div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="comment-text">نظر:</label>
                                    </div>
                                    <div class="col-md-10">
                                        <textarea name="comment" id="comment-text" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-2">
                                        @if(!\Auth::id())
                                            <div class="half-seperate"></div>
                                            برای ثبت نظر خود باید ابتدا 
                                            <a href="{{ url('user/login') }}" class="">
                                                در سایت وارد شوید
                                            </a>
                                            یا
                                            <a href="{{ url('user/register') }}" class="">
                                                 ثبت نام 
                                            </a>
                                            نمایید.
                                        @else
                                            <input type="submit" class="btn btn-success btn-block" value="ارسال نظر">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="mazaya" class="tab-pane">
                <h3 class="page-header text-center">
                بررسی تخصصی محصول
                </h3>
            </div>

            <div id="moshabeh" class="tab-pane">
                <h3 class="page-header text-center">
                محصولات مشابه
                </h3>
            </div>

            <div id="gallery" class="tab-pane">
                <h3 class="page-header text-center">
                گالری تصاویر
                </h3>
            </div>
        </div>
        <div class="seperate"></div>
        <div class="seperate"></div>
        <div class="seperate"></div>
    </div>
</div>
<div class="seperate"></div>
<div class="seperate"></div>
<div class="seperate"></div>
</div>
<div class="footer-gradiante-fix"></div>
@endsection
@push('script')
<script>
function magnify(event) {
    var Imageselected = document.getElementById("image-id");
    var imagewidthe = Imageselected.width;
    var imageheight = Imageselected.height;
    var offsetTop1 = Imageselected.offsetTop;
    var offsetLeft1 = Imageselected.offsetLeft;
    var x = event.clientX;
    var y = event.clientY;
    var lens = document.getElementById("canvas1");
    var hashie = document.getElementById("canvas2");
    var baseimage = document.getElementById("imageid1");
    var scrollWidth = window.scrollX;
    var scrollHeight = window.scrollY;
    y = y + scrollHeight ; 
    x = x + scrollWidth ;
    posY = y - offsetTop1 ;
    posX = x - offsetLeft1 ;
    hashie.style.display = "none"; 
    if (x>Imageselected.offsetLeft && x<Imageselected.offsetLeft+imagewidthe && y>(offsetTop1+20) && y<(offsetTop1+imageheight-20)) {
        hashie.style.display = "block";
        console.log(y,offsetTop1);
    }
    else {
        hashie.style.display = "none";
    }
	
    lens.src = '{{ $product->base_image() }}';
    lens.style.top = -2*posY+75+"px";
    lens.style.left = -2*posX+75+"px";
    lens.style.height = (2*(baseimage.height))+"px";
    lens.style.width = (2*(baseimage.width))+"px";;

    hashie.style.top = y-75+"px";
    hashie.style.left = x-75+"px";          
}


$(document).ready(function(){
    $('#related-product-slider').owlCarousel({
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
});
</script>

@endpush
