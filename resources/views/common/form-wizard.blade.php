<div class="row">
<div class="col-xs-12">
<section>
<div class="wizard">
    <div class="wizard-inner">
        <div class="connecting-line"></div>
        <ul class="nav nav-tabs" role="tablist">
            <li class="active">
                <a href="{{ $form['type'] == 'shipping' || $form['type'] == 'payment' ? '/checkout/address' : 'javascript:void(0)' }}" title="آدرس دهی">
                    <span class="round-tab">
                        <i class="fa fa-map-marker"></i>
                    </span>
                </a>
            </li>
            <li class="{{ $form['type'] == 'shipping' || $form['type'] == 'payment' ? 'active' : 'disabled' }}">
                <a href="{{ $form['type'] == 'payment' ? '/checkout/shipping' : 'javascript:void(0)' }}" title="روش ارسال">
                    <span class="round-tab">
                        <i class="fa fa-truck"></i>
                    </span>
                </a>
            </li>
            <li class="{{ $form['type'] == 'payment' ? 'active' : 'disabled' }}">
                <a href="javascript:void(0)" title="پرداخت">
                    <span class="round-tab">
                        <i class="fa fa-credit-card"></i>
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>
</section>
</div>
</div>

<!-- <div class="seperate"></div>
<div class="row text-center steps-row-css">
    <div class="col-xs-4">
        <a href="{{ url('/checkout/address') }}">
            <img src="{{ asset('/images/step1.png') }}" alt="مرحله ۱">
            <div class="half-seperate"></div>
            <p>
            <span class="glyphicon glyphicon-check hidden-xs"></span>
            انتخاب آدرس 
            </p>
        </a>
    </div>
    <div class="col-xs-4">
        <a href="{{ url('/checkout/shipping') }}">
            <img src="{{ asset('/images/step2.png') }}" alt="مرحله ۲">
            <div class="half-seperate"></div>
            <p class="bold">
                انتخاب روش ارسال 
            </p>
        </a>
    </div>
    <div class="col-xs-4">
        <img src="{{ asset('/images/step2.png') }}" alt="مرحله ۳">
        <div class="half-seperate"></div>
        <p>
            انتخاب روش پرداخت
        </p>
    </div>
</div>
<div class="seperate"></div>

 -->





<!-- <div class="row text-center steps-row-css">
    <div class="col-xs-4">
        <a href="{{ url('/checkout/address') }}">
            <img src="{{ asset('/images/step1.png') }}" alt="مرحله ۱">
            <div class="half-seperate"></div>
            <p class="bold">
            انتخاب آدرس 
            </p>
        </a>
    </div>
    <div class="col-xs-4">
        <img src="{{ asset('/images/step2.png') }}" alt="مرحله ۲">
        <div class="half-seperate"></div>
        <p >
            انتخاب روش ارسال 
        </p>
    </div>
    <div class="col-xs-4">
        <img src="{{ asset('/images/step2.png') }}" alt="مرحله ۳">
        <div class="half-seperate"></div>
        <p>
            انتخاب روش پرداخت
        </p>
    </div>
</div> -->




<!-- 


<div class="seperate"></div>
<div class="row text-center steps-row-css">
    <div class="col-xs-4">
        <a href="{{ url('/checkout/address') }}">
            <img src="{{ asset('/images/step1.png') }}" alt="مرحله ۱">
            <div class="half-seperate"></div>
            <p>
            <span class="glyphicon glyphicon-check hidden-xs"></span>
            انتخاب آدرس 
            </p>
        </a>
    </div>
    <div class="col-xs-4">
        <a href="{{ url('/checkout/shipping') }}">
            <img src="{{ asset('/images/step2.png') }}" alt="مرحله ۲">
            <div class="half-seperate"></div>
            <p>
                <span class="glyphicon glyphicon-check hidden-xs"></span>
                انتخاب روش ارسال 
            </p>
        </a>
    </div>
    <div class="col-xs-4">
        <a href="{{ url('/checkout/payment') }}">
            <img src="{{ asset('/images/step2.png') }}" alt="مرحله ۳">
            <div class="half-seperate"></div>
            <p class="bold">
                انتخاب روش پرداخت
            </p>
        </a>
    </div>
</div> -->
